<template>
    <form action="">
        <div class="field">
            <label class="label">Номера пропусков для оповещения</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <InputText v-model="dop_message" name="dop_message" id="dop_message" type="text" placeholder="Дополнительное сообщение" />
        <br>

        <Button @click.prevent="do_check" label="Начать оповещение" />
    </form>
    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <DataTable v-show="list.length > 0" stripedRows :rows="50" :value="list">
        <Column field="truc_number" header="Госномер"></Column>
        <Column field="email" header="e-mail">
            <template #body="slotProps">
                {{ slotProps.data.email }} <br> {{slotProps.data.email_dop }} <br> {{slotProps.data.email_dop2 }}
            </template>
        </Column>

        <Column field="pass" header="Пропуск">
            <template #body="slotProps">
                <span v-if="slotProps.data">
                    <Avatar v-if="slotProps.data.time == 'Дневной'" title="Дневной" icon="pi pi-sun" style="background-color: #dee9fc; color: #1a2551" />
                    <Avatar v-if="slotProps.data.time == 'Ночной'" title="Ночной" icon="pi pi-moon" style="background-color: #181f3c; color: white" />
                    {{ slotProps.data.pass }}
                </span>
            </template>
        </Column>
        <Column field="result" header="Статус">
            <template #body="slotProps">
                <Tag v-if="slotProps.data.result == '1'" icon="pi pi-check" severity="success" value="Отправлено" />
                <Tag v-if="slotProps.data.result == '0'" icon="pi pi-times" severity="danger" value="Не отправлено" />
            </template>
        </Column>
    </DataTable>

    <!-- <div v-show="list.length > 0" class="table_wrapper">
        <table>
            <thead>
                <tr>
                    <th>Пропуск</th>
                    <th>Госномер</th>
                    <th>Email</th>
                    <th>Время</th>
                    <th>Оповещение</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, i) in list" :key="i">
                    <td>{{ item.pass }}</td>
                    <td>{{ item.truc_number }}</td>
                    <td>{{ item.time }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ (item.result == "1")?'Отправлено':'Не отправлено' }}</td>
                </tr>
            </tbody>
        </table>
    </div> -->

</template>

<script setup>
    import { ref } from 'vue'
    import Button from 'primevue/button'

    import DataTable from 'primevue/datatable'
    import Column from 'primevue/column'
    import Tag from 'primevue/tag'
    import Avatar from 'primevue/avatar'

    import InputText from 'primevue/inputtext';


    let list_text = ref('БА-1324762, БА-1516048, БА0534768, БА1391311, БА-1403849')
    let list = ref([])
    let loader = ref(false)
    let dop_message = ref(null)

    let do_check = async () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        // mainnumbers.forEach((elem) => {
        for (let i = 0; i<mainnumbers.length; i++) {
            await axios.post('/send_alert', {
                'pass': mainnumbers[i],
                'message': dop_message.value
            })
            .then((resp) => {
                list.value.push(resp.data)
                console.log(resp.data)
                if (list.value.length == mainnumbers.length)
                    loader.value = false
            })
            .catch(error => {
                console.log(error)
                list.value.push({
                    'pass':mainnumbers[i],
                    'truc_number':error.message,
                    'time':"-",
                    'email':"-",
                    'email_dop':"-",
                    'email_dop2':"-",
                    'result':0,
                })
                if (list.value.length == mainnumbers.length)
                    loader.value = false
            });
        // })
        }
    }
</script>

<style>

</style>
