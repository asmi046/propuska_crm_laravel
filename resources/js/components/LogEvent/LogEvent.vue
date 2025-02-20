<template>
    <Card>
        <template #title>Фильтр</template>
        <template #content>
            <div class="filter_form">
                <Calendar :dateFormat="'dd.mm.yy'" v-model="data_range" selectionMode="range" inputId="birth_date" showIcon :showOnFocus="false" placeholder="Выберите даты" />
                <Dropdown v-model="event_type" :loading="locading" :options="event_types" optionLabel="name" placeholder="Выберите тип события" />
                <Dropdown v-model="state" :loading="locading" :options="statuses" optionLabel="name" placeholder="Выберите статус события" />
                <IconField iconPosition="right">
                    <InputIcon v-if="locading" class="pi pi-spin pi-spinner"> </InputIcon>
                    <InputIcon v-else class="pi pi-search"> </InputIcon>
                    <InputText type="text" v-model="serch"  placeholder="Поиск"/>
                </IconField>
            </div>
            <br>
            <group-process-selector :selected="selectedProduct" :callback="selectClear"> </group-process-selector>
        </template>
    </Card>



    <br>
        <svg v-show="locading" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>

    <DataTable stripedRows v-model:selection="selectedProduct" paginator :rows="100" :value="events" :rowsPerPageOptions="[100, 150, 200, 500]">
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
        <Column field="state" header="Статус">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.state == 'Непрочитанное'" icon="pi pi-question-circle" severity="secondary" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state == 'Прочитанное'" icon="pi pi-plus-circle" severity="success" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state == 'Важное'" icon="pi pi-megaphone" severity="danger" :value="slotProps.data.state" />
            </template>
        </Column>

        <Column field="created_at" header="Зафиксированно">
            <template #body="slotProps">
                {{ new Date(slotProps.data.created_at).toLocaleString() }}
            </template>
        </Column>
        <Column field="event_name" header="Событие"></Column>
        <Column field="event_date" header="Дата события">
            <template #body="slotProps">
                {{
                // new Date(slotProps.data.event_date).toLocaleString()
                new Date(slotProps.data.event_date).toLocaleDateString('ru-RU', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })

                }}
            </template>
        </Column>
        <Column field="pass_end_date" header="Дата окончания">
            <template #body="slotProps">
                {{
                    slotProps.data.pass_end_date?new Date(slotProps.data.pass_end_date).toLocaleString():""
                }}
            </template>
        </Column>
        <Column field="number" header="Госномер"></Column>
        <Column field="pass_number" header="Номер пропуска"></Column>
        <Column field="truc.email" header="E-mail">
            <template #body="slotProps">
                <p v-if="slotProps.data.truc && slotProps.data.truc.email != ''">{{slotProps.data.truc.email}}</p>
                <p v-if="slotProps.data.truc && slotProps.data.truc.email_dop != ''">{{slotProps.data.truc.email_dop}}</p>
                <p v-if="slotProps.data.truc && slotProps.data.truc.email_dop2 != ''">{{slotProps.data.truc.email_dop2}}</p>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import Calendar from 'primevue/calendar';
import Card from 'primevue/card';
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Tag from 'primevue/tag';

import GroupProcessSelector from './GroupProcessSelector.vue'

import { ref, watch } from 'vue';


const addDays = (date, days) => {
    const newDate = new Date(date);
    newDate.setDate(date.getDate() + days);
    return newDate;
}

let events = ref([])
let data_range = ref([addDays(new Date(), -1), addDays(new Date(), 1)])

const selectedProduct = ref()



let event_type = ref('')
let event_types = ref([
    { name: 'Любые события', code: '%'},
    { name: 'До окончания пропуска осталось 30 дней', code: 'До окончания пропуска осталось 30 дней'},
    { name: 'До окончания пропуска осталось 60 дней', code: 'До окончания пропуска осталось 60 дней'},
])

let locading = ref(false)
let serch = ref('')
let state = ref('')

const statuses = [
    { name: "Любой статус", code: "%" },
    { name: "Непрочитанное", code: "Непрочитанное" },
    { name: "Прочитанное", code: "Прочитанное" },
    { name: "Важное", code: "Важное" }
];

const toMysqlFormat = (date) => date.toISOString().split('T').join(' ').slice(0, 19);

watch([data_range, event_type, serch, state], (newV, oldV) => {
    getEventList()
});


const selectClear = () => {
    selectedProduct.value = []
}

const get_parametrs = () => {
    return {
        start_data: data_range.value[0]?toMysqlFormat(data_range.value[0]):"",
        end_data: data_range.value[1]?toMysqlFormat(data_range.value[1]):"",
        event_name: event_type.value.code? event_type.value.code: '%',
        state: state.value.code? state.value.code: '%',
        serch: serch.value? serch.value: '%'
    }
}

const getEventList = async () => {

    locading.value = true
    await axios.get('/get_event_list', {
            params: get_parametrs()
        })
            .then((resp) => {
                locading.value = false
                events.value = resp.data;
                console.log(events.value)
            })
            .catch(error => {
                locading.value = false
                console.log(error)
             });
}

getEventList()

</script>
