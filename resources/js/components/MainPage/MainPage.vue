<template>
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
        <Column field="last_pass.pass_number" header="Номер"></Column>
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
import { ref } from 'vue'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import SplitButton from 'primevue/splitbutton';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import Avatar from 'primevue/avatar';
import ControlCell from './ControlCell.vue'

let passes = ref([])

axios.get('/get_all_numbers')
            .then((resp) => {
                console.log(resp.data)

                passes.value = resp.data;
            })
            .catch(error => console.log(error));

</script>

<style>

</style>
