<template>
    <form class="check_truc_number_form" :action="action" method="GET">
        <InputText class="vue_field" type="text" name="truc_number" v-model="grn" placeholder="Государственный регистрационный номер" />
        <Button type="submit" label="Проверить" />
    </form>
    <br>
    <br>
    <DataTable v-if="props.grndata" stripedRows  :rows="50" :value="props.grndata">
        <Column field="truck_num" header="Госномер"></Column>
        <Column field="pass" header="Пропуск">
            <template #body="slotProps">
                <span v-if="slotProps.data">
                    <Avatar v-if="slotProps.data.type_pass == 'Дневной'" title="Дневной" icon="pi pi-sun" style="background-color: #dee9fc; color: #1a2551" />
                    <Avatar v-if="slotProps.data.type_pass == 'Ночной'" title="Ночной" icon="pi pi-moon" style="background-color: #181f3c; color: white" />
                    {{ slotProps.data.series +' '+slotProps.data.pass_number }}
                </span>
            </template>
        </Column>

        <Column field="valid_from" header="Действует c"></Column>
        <Column field="valid_to" header="Действует до"></Column>

        <Column field="sys_status" header="Статус">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.sys_status == 'Действует'" icon="pi pi-check" severity="success" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Начинается сегодня'" icon="pi pi-check" severity="success" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Начинается завтра'" icon="pi pi-check" severity="success" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Анулирован'" icon="pi pi-times" severity="danger" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Закончился'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Заканчивается сегодня'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.sys_status" />
                <Tag v-if="slotProps.data.sys_status == 'Заканчивается завтра'" icon="pi pi-exclamation-triangle" severity="warning" :value="slotProps.data.sys_status" />
            </template>
        </Column>

        <Column sortable field="deycount" header="Осталось дней"></Column>

    </DataTable>
    <strong v-else>По вашему запросу ничего не найдено</strong>
</template>

<script setup>
import { ref } from 'vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Tag from 'primevue/tag'
import Avatar from 'primevue/avatar'

const props = defineProps({
  action: String,
  number: String,
  grndata: Object,
})

let grn = ref(props.number)

</script>
