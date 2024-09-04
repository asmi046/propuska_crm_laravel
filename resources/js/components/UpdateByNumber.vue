<template>
    <form action="">
        <div class="field">
            <label class="label">Номера пропусков для обновления данных</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <Button :disabled="loader" @click.prevent="do_update" label="Начать обновление" />
    </form>
    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <DataTable v-show="list.length > 0" stripedRows :rows="50" :value="list">

        <Column field="pass_number" header="Пропуск"></Column>
        <Column field="truck_number" header="Госномер">
            <template #body="slotProps">
                {{ slotProps.data.truck_number }}
                <span v-if="slotProps.data.rus"> (RUS)</span>
                <span v-else> (ZAG)</span>
            </template>
        </Column>
        <Column field="valid_from" header="Действует с"></Column>
        <Column field="valid_to" header="Действует по"></Column>
        <Column field="state" header="Результат проверки">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.state == 'Данные обновлены' || slotProps.data.state == 'Данные обновлены*'" icon="pi pi-check" severity="success" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state == 'Госномер добавлен в базу'" icon="pi pi-times" severity="info" :value="slotProps.data.state" />
                <Tag v-if="slotProps.data.state != 'Данные обновлены' && slotProps.data.state != 'Данные обновлены*' && slotProps.data.state != 'Госномер добавлен в базу'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
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

    let list_text = ref('БА1652499, БА1350855, БА1378366, БА1643473, БА-1403849')
    let list = ref([])
    let loader = ref(false)

    let do_update = async () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        for (let i = 0; i<mainnumbers.length; i++) {
            if (mainnumbers[i] == "") continue;

            await axios.get('/update_by_numbers_do/' + mainnumbers[i])
            .then((resp) => {
                list.value.push(resp.data)
                console.log(resp.data)
            })
            .catch(error => {
                console.log(error)
                list.value.push({
                    'pass_number': mainnumbers[i],
                    'truck_number': "",
                    'valid_from': "",
                    'valid_to': "",
                    'state': error.message,
                })
            });
        }

        loader.value = false
    }
</script>

<style>

</style>
