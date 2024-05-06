<template>
    <form action="">
        <div class="field">
            <label class="label">Номера пропусков для оповещения</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <button @click.prevent="do_check" >Начать оповещение</button>
    </form>
    <br>
    <svg v-show="loader" class="loader_icon">
        <use xlink:href="#loader"></use>
    </svg>
    <br>

    <div v-show="list.length > 0" class="table_wrapper">
        <table>
            <thead>
                <tr>
                    <th>Зона</th>
                    <th>Номер</th>
                    <th>Время</th>
                    <th>Действует с</th>
                    <th>Действует по</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, i) in list" :key="i">
                    <td>{{ item[0] }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script setup>
    import { ref } from 'vue'

    let list_text = ref('БА-0686465, БА-1470909, БА-1397420, БА-1351589, БА-1531232')
    let list = ref([])
    let loader = ref(false)

    let do_check = () => {
        loader.value = true
        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        mainnumbers.forEach((elem) => {
            axios.post('/send_alert', {
                'pass': elem,
            })
            .then((resp) => {
                list.value.push(resp.data)
                if (list.value.length == mainnumbers.length)
                    loader.value = false
            })
            .catch(error => console.log(error));
        })
    }
</script>

<style>

</style>
