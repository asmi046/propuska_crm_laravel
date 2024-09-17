<template>
    <form action="">
        <div class="field">
            <label class="label">E-mail для удаления номеров из базы</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <Button @click.prevent="do_check" label="Начать удаление" />
    </form>
    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <DataTable v-show="list.length > 0" stripedRows :rows="50" :value="list">

        <Column field="email" header="e-mail">
            <template #body="slotProps">
                {{ slotProps.data.email }} <br> {{slotProps.data.email_dop }} <br> {{slotProps.data.email_dop2 }}
            </template>
        </Column>

        <Column field="count_number" header="Количество номеров"></Column>
        <Column field="numbers" header="Список удаленных номеров"></Column>
    </DataTable>


</template>

<script setup>
    import { ref } from 'vue'
    import Button from 'primevue/button'

    import DataTable from 'primevue/datatable'
    import Column from 'primevue/column'

    let list_text = ref('')
    let list = ref([])
    let loader = ref(false)

    let do_check = async () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)


        const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;

        for (let i = 0; i<mainnumbers.length; i++) {
            if (mainnumbers[i] == "") continue;
            if (!EMAIL_REGEXP.test(mainnumbers[i])) {
                list.value.push({
                    'email':mainnumbers[i],
                    'count_number': 0,
                    'numbers': "Неверный формат e-mail"
                })
                continue;
            }

            await axios.post('/delete_by_email_do', {
                'email': mainnumbers[i],
            })
            .then((resp) => {
                list.value.push(resp.data)
                console.log(resp.data)
            })
            .catch(error => {
                console.log(error)
                list.value.push({
                    'email':mainnumbers[i],
                    'count_number': 0,
                    'numbers': error.message
                })
            });
        }

        loader.value = false
    }
</script>

<style>

</style>
