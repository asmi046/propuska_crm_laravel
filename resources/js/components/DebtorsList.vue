<template>
    <form class="check_truc_number_form" action="#">
        <InputText class="vue_field" type="text" name="truc_number" v-model="serch" placeholder="Искать по госномеру или e-mail" />
        <Button icon="pi pi-times" severity="secondary" type="submit" label="Сбросить" @click.prevent="clearFilter" />
        <Button class="ml10" icon="pi pi-check" severity="success" type="submit" label="Проверить e-mail" @click.prevent="checkEmail" />

    </form>

    <br>
        <svg v-show="loader" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>

    <br>
    <div v-show="props.session" class="form-status form-status--success">{{ props.session }}</div>
    <br>
    <div v-show="check_result != null" class="stat">
        <p>Всего: <strong>{{ check_result?check_result.all:"" }}</strong></p>
        <p>Корректно: <strong>{{ check_result?check_result.correct:"" }}</strong></p>
        <p>Некорректно: <strong>{{ check_result?check_result.incorrect:"" }}</strong></p>
    </div>
    <br>

    <DataTable v-if="list.length != 0" stripedRows  paginator :rows="50" :value="list">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="email" header="e-mail"></Column>
        <Column field="adding_data" header="Дата добавления"></Column>
        <Column field="deys" sortable header="Просрочено дней"></Column>

        <Column field="true_email" sortable header="e-mail в базе">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.true_email" icon="pi pi-check" severity="success" value="Совпадает" />
                <Tag v-if="slotProps.data.true_email == false" icon="pi pi-times" severity="danger" value="Исправлен" />
                <Tag v-if="slotProps.data.true_email == null" icon="pi pi-times" severity="secondary" value="Непроверен" />
            </template>
        </Column>

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

import Tag from 'primevue/tag'

const props = defineProps({
  action: String,
  session: String
})

let check_result = ref(null)

let list = ref([])
let serch = ref('')

let loading = ref(false)
let loader = ref(false)

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

const checkEmail  = () => {

    loader.value = true;
    axios.get('/email_check').then((resp) => {
        getDebtorsList()
        check_result.value = resp.data
        loader.value = false
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
