<template>
<Toast />
<div class="df g20">
        <InputText class="f1" v-model="truck_number" type="text" placeholder="Номер грузовика" />
        <InputMask class="f1" id="basic" v-model="sts_data" placeholder="00.00.0000" mask="99.99.9999" slotChar="__.__.____" />

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
            <Column field="sts_data" header="Дата нового СТС"></Column>
            <Column sortable field="email" header="e-mail"></Column>
            <Column field="last_message" header="Последнее оповещение"></Column>

            <Column field="state" header="Управление">
                <template #body="{ data }">
                    <Button type="button" label="Удалить" icon="pi pi-times" severity="danger" @click="delet(data.id)" />
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
    import InputMask from 'primevue/inputmask';

    import Toast from 'primevue/toast';
    import { useToast } from 'primevue/usetoast';
    const toast = useToast();

    let loader = ref(false)
    var truck_number = ref("")
    var sts_data = ref("")
    let alert_list = ref([])

    const filters = ref({
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        truc_number: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        email: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    });

    let get_alert_list = () => {
        loader.value = true
        axios.get('/get_sts_alert_list')
            .then((resp) => {
                alert_list.value = resp.data
                loader.value = false
            })
            .catch(error => {
                console.log(error)
                loader.value = false
            });
    }

    let delet = (id) => {
        loader.value = true
        console.log(id)
        axios.get('/sts_alert_delete/'+id)
            .then((resp) => {
                alert_list.value = alert_list.value.filter((element) => element.id != id)
                loader.value = false
                toast.add(
                    {
                        severity: 'success',
                        summary: 'Удаление',
                        detail: 'Номер удален', life: 2000
                    }
                );
            })
            .catch(error => {
                console.log(error)
                loader.value = false
                toast.add(
                    {
                        severity: 'error',
                        summary: 'Ошибка удаления',
                        detail: error.response.data.message, life: 2000
                    }
                );
            });
    }

    let do_add = async () => {
        loader.value = true

        await axios.post('/sts_alert_add', {
            truck_number:truck_number.value,
            sts_data:sts_data.value,
        })
        .then((resp) => {
            alert_list.value.push(resp.data)
            truck_number.value = "",
            sts_data.value = "",
            loader.value = false
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
            loader.value = false
            toast.add(
                {
                    severity: 'error',
                    summary: 'Ошибка',
                    detail: error.response.data.message, life: 2000
                }
            );
        });



    }

    get_alert_list()

</script>

