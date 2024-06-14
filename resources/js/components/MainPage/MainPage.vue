<template>
    <Card>
        <template #title>Фильтр</template>
        <template #content>
            <div class="filter_form">
                <Dropdown v-model="state" :loading="locading"  :options="state_list" optionLabel="name" placeholder="Выберите статус" />
                <Dropdown v-model="series" :loading="locading" :options="series_list" optionLabel="name" placeholder="Выберите тип пропуска" />
                <IconField iconPosition="right">
                    <InputIcon v-if="locading" class="pi pi-spin pi-spinner"> </InputIcon>
                    <InputIcon v-else class="pi pi-search"> </InputIcon>
                    <InputText type="text" v-model="serch"  placeholder="Поиск"/>
                </IconField>

                <Button icon="pi pi-times" severity="secondary" type="submit" label="Сбросить" @click.prevent="clearFilter" />
            </div>
        </template>
    </Card>

    <br>
    <br>

    <DataTable stripedRows  paginator :rows="50" :value="passes">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="email" header="e-mail"></Column>
        <Column field="last_pass.pass_zone" header="Зона"></Column>
        <Column field="pass" header="Пропуск">
            <template #body="slotProps">
                <span v-if="slotProps.data.last_pass">
                    <Avatar v-if="slotProps.data.last_pass.type_pass == 'Дневной'" title="Дневной" icon="pi pi-sun" style="background-color: #dee9fc; color: #1a2551" />
                    <Avatar v-if="slotProps.data.last_pass.type_pass == 'Ночной'" title="Ночной" icon="pi pi-moon" style="background-color: #181f3c; color: white" />
                    {{ slotProps.data.last_pass.series +' '+slotProps.data.last_pass.pass_number }}
                </span>
            </template>
        </Column>
        <Column field="sys_status" header="Статус">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Действует'" icon="pi pi-check" severity="success" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Начинается сегодня'" icon="pi pi-check" severity="success" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Начинается завтра'" icon="pi pi-check" severity="success" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Анулирован'" icon="pi pi-times" severity="danger" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Закончился'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Заканчивается сегодня'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.last_pass.sys_status" />
                <Tag v-if="slotProps.data.last_pass && slotProps.data.last_pass.sys_status == 'Заканчивается завтра'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.last_pass.sys_status" />
            </template>
        </Column>
        <Column field="last_pass.valid_from" header="Действует c"></Column>
        <Column field="last_pass.valid_to" header="Действует до"></Column>
        <Column field="last_pass.cancel_date" header="Аннулирован"></Column>
        <Column sortable  field="last_pass.deycount" header="Осталось дней"></Column>
        <Column  field="control" header="Управление">
            <template #body="slotProps">
                <control-cell :gn="slotProps.data.truc_number" :id="slotProps.data.id"></control-cell>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { ref, watch } from 'vue'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import SplitButton from 'primevue/splitbutton';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import Avatar from 'primevue/avatar';
import ControlCell from './ControlCell.vue'
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button'

import Card from 'primevue/card';

import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';


let passes = ref([])

let state = ref('')
const state_list = [
    { name: "Действует", code: "Действует" },
    { name: "Анулирован", code: "Анулирован" },
    { name: "Закончился", code: "Закончился" },
    { name: "Начинается сегодня", code: "Начинается сегодня" },
    { name: "Начинается завтра", code: "Начинается завтра" },
    { name: "Заканчивается завтра", code: "Заканчивается завтра" },
    { name: "Заканчивается сегодня", code: "Заканчивается сегодня" }

];
let series = ref('')
const series_list = [
    { name: "БА", code: "БА" },
    { name: "ББ", code: "ББ" },
];
let serch = ref('')

watch([state, series, serch], () => {
    getNumbersList()
});

let locading = ref(false)

const getNumbersList = () => {
    locading.value = true
    axios.get('/get_all_numbers', {
            params: {
                'sys_statuse': state.value,
                'series': series.value,
                'serch': serch.value,
            }
        })
            .then((resp) => {
                locading.value = false

                passes.value = resp.data;
            })
            .catch(error => {
                locading.value = false
                console.log(error)
             });
}

const clearFilter = () => {
    state.value = ""
    series.value = ""
    serch.value = ""
}

getNumbersList()

</script>

<style>

</style>
