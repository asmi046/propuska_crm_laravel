<template>
    <br>
        <svg v-show="loader" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>
    <div class="columns">
        <div class="column cl_left">
            <h4>Добавление номеров:</h4>
            <form action="">
                <div class="field">
                    <label class="label">Номера авто для добавления</label>
                    <div class="control">
                        <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
                    </div>
                </div>

                <Button @click.prevent="do_add" label="Начать добавление" />
            </form>

            <DataTable v-show="list.length > 0" stripedRows :rows="50" :value="list">
                <Column field="truc_number" header="Госномер"></Column>
                <Column field="email" header="e-mail"></Column>

                <Column field="state" header="Статус">
                    <template #body="slotProps">
                        <Tag v-if="slotProps.data.state == 'Добавлен'" icon="pi pi-check" severity="success" :value="slotProps.data.state" />
                        <Tag v-if="slotProps.data.state == 'Не найден в основной базе'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
                        <Tag v-if="slotProps.data.state == 'Уже есть номер в базе оповещения'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
                    </template>
                </Column>
            </DataTable>
        </div>
        <div class="column cl_right">
            <h4>Список оповещения:</h4>
            <DataTable v-model:filters="filters" v-show="alert_list.length > 0" stripedRows :rows="30" :value="alert_list">
                <template #header>
                    <div class="flex justify-content-end">
                        <IconField iconPosition="left">
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Введите запрос" />
                        </IconField>
                    </div>
                </template>
                <Column field="truc_number" header="Госномер"></Column>
                <Column field="email" header="e-mail"></Column>
                <Column field="last_message" header="Последнее оповещение"></Column>

                <Column field="state" header="Управление">
                    <template #body="{ data, index }">
                        <Button type="button" label="Удалить" icon="pi pi-times" severity="danger" @click="delet(data.id, index)" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'

    import Button from 'primevue/button'

    import DataTable from 'primevue/datatable'
    import Column from 'primevue/column'
    import Tag from 'primevue/tag'
    import { FilterMatchMode } from 'primevue/api';
    import InputText from 'primevue/inputtext'
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';

    let list_text = ref('М848ВУ790, М889ВУ790, БА0534768, В024ВС790, Р986АМ68')
    let loader = ref(false)
    let list = ref([])
    let alert_list = ref([])

    const filters = ref({
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        truc_number: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        email: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    });

    let get_alert_list = () => {
        loader.value = true
        axios.get('/get_alert_list/')
            .then((resp) => {
                alert_list.value = resp.data
                loader.value = false
            })
            .catch(error => {
                console.log(error)
                loader.value = false
            });
    }

    let delet = (id, index) => {
        loader.value = true
        console.log(id)
        axios.get('/to_alert_delete/'+id)
            .then((resp) => {
                alert_list.value.splice(index, 1)
                loader.value = false
            })
            .catch(error => {
                console.log(error)
                loader.value = false
            });
    }

    let do_add = async () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        for (let i = 0; i<mainnumbers.length; i++) {
            await axios.post('/to_alert_add/'+mainnumbers[i])
            .then((resp) => {
                list.value.push(resp.data)
            })
            .catch(error => {
                console.log(error)
                list.value.push({
                    'truc_number': mainnumbers[i],
                    'email': "",
                    'state': error.message
                })
            });
        }

        loader.value = false
        get_alert_list()

    }

    get_alert_list()

</script>

