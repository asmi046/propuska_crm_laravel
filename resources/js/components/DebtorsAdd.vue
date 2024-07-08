<template>
    <form action="">
        <div class="field">
            <label class="label">Госномера должнеков для добавления</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <Button @click.prevent="do_add" label="Добавить" />
    </form>

    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <DataTable v-show="list.length > 0" stripedRows  :rows="50" :value="list">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="email" header="e-mail"></Column>

        <Column field="state" header="Статус">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.state == 'Добавлен в базу'" icon="pi pi-check" severity="success" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state == 'Не найден в основной базе'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state == 'Уже в базе должников'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
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

    let list_text = ref('В228ТМ26, С739АА93, А311НО763, А741СВ763, С948ЕЕ123, Х755ОС750')
    let list = ref([])
    let loader = ref(false)

    let do_add = () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        for (let i = mainnumbers.length; i>0; i--) {
            axios.post('/debtors_add_do', {
                'number': mainnumbers[i-1],
            })
            .then((resp) => {
                list.value.push(resp.data)
                console.log(resp.data)

                if (list.value.length == mainnumbers.length)
                    loader.value = false
            })
            .catch(error => {
                console.log(error)
            });
        }

        // mainnumbers.forEach((elem) => {
        //     axios.post('/debtors_add_do', {
        //         'number': elem,
        //     })
        //     .then((resp) => {
        //         list.value.push(resp.data)
        //         console.log(resp.data)

        //         if (list.value.length == mainnumbers.length)
        //             loader.value = false
        //     })
        //     .catch(error => {
        //         console.log(error)
        //     });
        // })
    }
</script>
