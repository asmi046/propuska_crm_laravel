<template>
    <ConfirmDialog></ConfirmDialog>
    <Toast />
    <form action="">
        <div class="field">
            <label class="label">Госномера должнеков для проверки</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <Button @click.prevent="do_check" label="Проверить" />
    </form>

    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <Splitter v-show="out_base.length > 0 || in_base.length > 0" class="mb-5">
            <SplitterPanel class="flex align-items-center justify-content-center p20">
                <h2>Соответствует списку ({{ in_base.length }})</h2>

                <DataTable  stripedRows  :rows="50" :value="in_base">
                    <Column field="truc_number" header="Госномер">
                        <template #body="slotProps">
                            <Tag icon="pi pi-check" severity="success" :value="slotProps.data.truc_number" />
                        </template>
                    </Column>
                    <Column field="email" header="e-mail"></Column>
                    <Column field="deys" header="Задолженность (дней)"></Column>
                </DataTable>
            </SplitterPanel>

            <SplitterPanel class="flex align-items-center justify-content-center p20">
                <h2>Есть в базе но нет в списке ({{ out_base.length }})</h2>

                <DataTable v-show="out_base.length > 0" stripedRows  :rows="50" :value="out_base">
                    <Column field="truc_number" header="Госномер">
                        <template #body="slotProps">
                            <Tag icon="pi pi-times" severity="danger" :value="slotProps.data.truc_number" />
                        </template>
                    </Column>
                    <Column field="email" header="e-mail"></Column>
                    <Column field="deys" header="Задолженность (дней)"></Column>
                </DataTable>
                <br><br>
                <Button @click="deleteAll" label="Удалить все номера" icon="pi pi-trash" severity="danger" />
                <br><br>
                <h2>Есть в списке но нет в базе ({{ out_list.length }})</h2>
                <DataTable v-show="out_list.length > 0" stripedRows  :rows="50" :value="out_list">
                    <Column field="truc_number" header="Госномер">
                        <template #body="slotProps">
                            <Tag severity="info" :value="slotProps.data.truc_number" />
                        </template>
                    </Column>
                </DataTable>
            </SplitterPanel>
    </Splitter>


</template>

<script setup>
    import { ref } from 'vue'

    import Button from 'primevue/button'

    import DataTable from 'primevue/datatable'
    import Column from 'primevue/column'
    import Tag from 'primevue/tag'

    import Splitter from 'primevue/splitter';
    import SplitterPanel from 'primevue/splitterpanel';
    import Toast from 'primevue/toast';
    import ConfirmDialog from 'primevue/confirmdialog';
    import { useConfirm } from "primevue/useconfirm";
    import { useToast } from 'primevue/usetoast';

    const confirm = useConfirm();
    const toast = useToast();

    let list_text = ref('Х173ТХ15, Е999ОР21, С900РК39, О600СК799, Т304ВА39, О286УТ777, К672СС799, А847ЕЕ750, В386УА790, А799ВУ37, А222ВУ22, А777ВУ77')
    let in_base = ref([])
    let out_base = ref([])
    let out_list = ref([])
    let loader = ref(false)

    let do_check = async () => {
        loader.value = true
        in_base.value = []
        out_base.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)


        axios.get('/debtors_chek_do', {
            params: {
                list: mainnumbers,
            }
        })
        .then((resp) => {
                loader.value = false
                in_base.value = resp.data['in_base']
                out_base.value = resp.data['out_base']
                out_list.value = resp.data['empty']
                console.log(resp.data)
        })
        .catch(error => {
            loader.value = false
            console.log(error)
        });

    }


    const deleteAllDo = async () => {
        loader.value = true

        for (let index in out_base.value) {
            await axios.get('/debtors_dell_return/'+out_base.value[index].id)
            .then((resp) => {
                toast.add({ severity: 'success', summary: 'Удалено', detail: out_base.value[index].truc_number + ' - Должник удален', life: 2000 });
            })
            .catch(error => {
                toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Ошибка при удалении', life: 2000 });
                console.log(error)
            });
        }
        loader.value = false
    }

    const deleteAll = () => {
        confirm.require({
            message: 'Вы точно хотите удалить весь список?',
            header: 'Подтвердить удаление',
            icon: 'pi pi-exclamation-triangle',
            rejectClass: 'p-button-secondary p-button-outlined',
            acceptClass: 'p-button-danger',
            rejectLabel: 'Отмена',
            acceptLabel: 'Удалить',
            accept: () => {
                deleteAllDo()
            },
        });
    }

</script>
