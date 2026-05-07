<template>
    <form class="check_truc_number_form" action="#">
        <InputText
            class="vue_field"
            type="text"
            name="truc_number"
            v-model="serch"
            placeholder="Искать по госномеру"
        />
        <Button
            icon="pi pi-times"
            severity="secondary"
            type="submit"
            label="Сбросить"
            @click.prevent="clearFilter"
        />
        <Button
            class="ml10"
            icon="pi pi-search"
            severity="success"
            type="submit"
            label="Найти"
            @click.prevent="getRnisList"
        />
    </form>

    <br />
    <div v-show="props.session" class="form-status form-status--success">
        {{ props.session }}
    </div>
    <br />

    <DataTable
        v-if="list.length != 0"
        stripedRows
        paginator
        :rows="50"
        :value="list"
    >
        <Column field="truc_number" header="Госномер"></Column>
        <Column
            field="end_subscribe_sort"
            sortable
            header="Дата окончания подписки"
        >
            <template #body="slotProps">
                {{ slotProps.data.end_subscribe }}
            </template>
        </Column>
        <Column
            field="car_number.email"
            sortable
            header="Email для уведомления"
        ></Column>
    </DataTable>
    <strong v-else>Данных нет</strong>
</template>

<script setup>
import { ref, watch } from "vue";

import InputText from "primevue/inputtext";
import Button from "primevue/button";

import DataTable from "primevue/datatable";
import Column from "primevue/column";

const props = defineProps({
    action: String,
    session: String,
});

let list = ref([]);
let serch = ref("");

const parseDateForSort = (value) => {
    if (!value) {
        return 0;
    }

    if (/^\d{4}-\d{2}-\d{2}/.test(value)) {
        const timestamp = new Date(value).getTime();

        return Number.isNaN(timestamp) ? 0 : timestamp;
    }

    const match = value.match(/^(\d{2})\.(\d{2})\.(\d{4})$/);

    if (!match) {
        return 0;
    }

    const [, day, month, year] = match;
    const timestamp = new Date(`${year}-${month}-${day}`).getTime();

    return Number.isNaN(timestamp) ? 0 : timestamp;
};

const getRnisList = () => {
    axios
        .get(props.action, {
            params: {
                serch: serch.value == "" ? "" : serch.value,
            },
        })
        .then((resp) => {
            list.value = resp.data.map((item) => ({
                ...item,
                end_subscribe_sort: parseDateForSort(item.end_subscribe),
            }));
        })
        .catch((error) => console.log(error));
};

const clearFilter = () => {
    serch.value = "";
};

watch(serch, () => {
    getRnisList();
});

getRnisList();
</script>
