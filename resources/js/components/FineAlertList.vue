<template>
<Toast />
<div class="df g20">
        <InputText class="f1" v-model="truck_number" type="text" placeholder="Номер грузовика" />
        <InputText class="f1" v-model="fine_number" type="text" placeholder="Штраф" />
        <Button @click.prevent="do_add" label="Добавить" />

</div>

    <br>
        <svg v-show="loader" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>

    <h4>Список оповещения:</h4>
    <DataTable v-model:filters="filters" stripedRows :rows="30" :value="alert_list">
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
            <Column sortable  field="truc_number" header="Госномер"></Column>
            <Column field="fine_id" header="Штраф"></Column>
            <Column sortable field="email" header="e-mail"></Column>
            <Column field="last_message" header="Последнее оповещение"></Column>

            <Column field="state" header="Управление">
                <template #body="{ data, index }">
                    <Button type="button" label="Удалить" icon="pi pi-times" severity="danger" @click="delet(data.id, index)" />
                </template>
            </Column>
    </DataTable>


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

    import Toast from 'primevue/toast';
    import { useToast } from 'primevue/usetoast';
    const toast = useToast();

    let list_text = ref('М848ВУ790, М889ВУ790, БА0534768, В024ВС790, Р986АМ68')
    let loader = ref(false)
    var truck_number = ref("")
    var fine_number = ref("")
    let alert_list = ref([])

    const filters = ref({
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        truc_number: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        email: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    });

    let get_alert_list = () => {
        loader.value = true
        axios.get('/get_fine_alert_list')
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
        axios.get('/fine_alert_delete/'+id)
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

        await axios.post('/fine_alert_add', {
            truck_number:truck_number.value,
            fine_number:fine_number.value,
        })
        .then((resp) => {
            alert_list.value.push(resp.data)
            truck_number.value = "",
            fine_number.value = "",
            toast.add(
                {
                    severity: 'success',
                    summary: 'Добавлено',
                    detail: 'Номер добавлен в оповещения', life: 2000
                }
            );

        })
        .catch(error => {
            console.log(error)
            toast.add(
                {
                    severity: 'error',
                    summary: 'Ошибка',
                    detail: error.response.data.message, life: 2000
                }
            );
        });


        loader.value = false
    }

    get_alert_list()

</script>

