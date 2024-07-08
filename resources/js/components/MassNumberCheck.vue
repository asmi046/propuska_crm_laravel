<template>
    <form action="">
        <div class="field">
            <label class="label">Госномера для проверки</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <Button @click.prevent="do_check" label="Начать проверку" />
    </form>

    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <DataTable v-show="list.length > 0" stripedRows :rows="50" :value="list">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="state" header="Статус"></Column>

        <Column field="an" header="Активные пропуска">
            <template #body="slotProps">
                <pass-line :item="slotProps.data.an"></pass-line>
            </template>
        </Column>

        <Column field="an" header="Не активные пропуска">
            <template #body="slotProps">
                <pass-line :item="slotProps.data.n_an"></pass-line>
            </template>
        </Column>
    </DataTable>

</template>

<script setup>
    import { ref } from 'vue'
    import PassLine from './PassLine.vue'

    import Button from 'primevue/button'
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';


    let list_text = ref('В228ТМ26, С739АА93, А311НО763, А741СВ763, С948ЕЕ123, Х755ОС750')

    let list = ref([])
    let loader = ref(false)

    let do_check = () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)

        console.log(mainnumbers);

        mainnumbers.forEach((elem) => {

            axios.get('/mass_check_pass_info/'+elem)
            .then((resp) => {
                list.value.push({
                    "truc_number":elem,
                    "state":resp.data.state,
                    "an": resp.data.an,
                    "n_an": resp.data.n_an,
                })

                console.log(resp.data)

                if (list.value.length == mainnumbers.length)
                    loader.value = false
            })
            .catch((error) => {
                list.value.push({
                    "truc_number":elem,
                    "state": error.message,
                    "an": "",
                    "n_an": "",
                })


                if (list.value.length == mainnumbers.length)
                    loader.value = false

                console.log(error)
            });

        })
    }

</script>
