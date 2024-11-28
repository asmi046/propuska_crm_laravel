<template>
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
                <h2>Соответствует списку</h2>

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
                <h2>Есть в списке но нет в базе</h2>

                <DataTable v-show="out_base.length > 0" stripedRows  :rows="50" :value="out_base">
                    <Column field="truc_number" header="Госномер">
                        <template #body="slotProps">
                            <Tag icon="pi pi-times" severity="danger" :value="slotProps.data.truc_number" />
                        </template>
                    </Column>
                    <Column field="email" header="e-mail"></Column>
                    <Column field="deys" header="Задолженность (дней)"></Column>
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

    let list_text = ref('Х173ТХ15, Е999ОР21, С900РК39, О600СК799, Т304ВА39, О286УТ777, К672СС799, А847ЕЕ750, В386УА790, А799ВУ37')
    let in_base = ref([])
    let out_base = ref([])
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
                console.log(resp.data)
        })
        .catch(error => {
            loader.value = false
            console.log(error)
        });

    }
</script>
