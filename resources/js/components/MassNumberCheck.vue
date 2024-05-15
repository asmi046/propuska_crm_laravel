<template>
    <form action="">
        <div class="field">
            <label class="label">Госномера для проверки</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <button @click.prevent="do_check" >Начать проверку</button>
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
                    <th>Госномер</th>
                    <th>Статус</th>
                    <th>Активные пропуска</th>
                    <th>Последние пропуска</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, i) in list" :key="i">
                    <td>{{ item.truc_number }}</td>
                    <td>{{ item.state }}</td>
                    <td>
                        <pass-line :item="item.an"></pass-line>
                    </td>
                    <td>
                        <pass-line :item="item.n_an"></pass-line>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import PassLine from './PassLine.vue'


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
            .catch(error => console.log(error));

        })
    }

</script>
