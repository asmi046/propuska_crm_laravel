<template>
    <form class="check_truc_number_form" action="#">
        <InputText class="vue_field" type="text" name="truc_number" v-model="serch" placeholder="Искать по госномеру или e-mail" />
        <Button icon="pi pi-times" severity="secondary" type="submit" label="Сбросить" @click.prevent="clearFilter" />
    </form>

    <br>
    <br>
    <div v-show="props.session" class="form-status form-status--success">{{ props.session }}</div>
    <br>
    <br>

    <DataTable v-if="list.length != 0" stripedRows  paginator :rows="50" :value="list">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="email" header="e-mail"></Column>
        <Column field="adding_data" header="Дата добавления"></Column>
        <Column field="deys" sortable header="Просрочено дней"></Column>

        <Column field="state" header="Управление">
            <template #body="slotProps">
                <Button type="button" label="Удалить" icon="pi pi-times" severity="danger" :loading="loading" @click="deleteElement(slotProps.data.id)" />
            </template>
        </Column>

    </DataTable>
    <strong v-else>Должников нет в базе</strong>
</template>

<script setup>
import { ref, watch } from 'vue'

import InputText from 'primevue/inputtext'
import Button from 'primevue/button'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'

const props = defineProps({
  action: String,
  session: String
})

let list = ref([])
let serch = ref('')

let loading = ref(false)

const getDebtorsList = () => {
    axios.get(props.action, {
            params: {
                'serch': (serch.value == "")?"":serch.value
            }
        })
            .then((resp) => {
                console.log(resp.data)

                list.value = resp.data;
            })
            .catch(error => console.log(error));
}

const deleteElement = (debtor_id) => {
    window.location.href = "/debtors_dell/"+debtor_id
}

const clearFilter = () => {
    serch.value = ""
}

watch(serch, (newValue, oldValue) => {
    getDebtorsList()
});

getDebtorsList()


</script>
