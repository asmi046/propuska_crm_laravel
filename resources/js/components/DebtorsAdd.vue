<template>
    <form action="">
        <div class="field">
            <label class="label">Госномера должнеков для добавления</label>
            <div class="control">
                <textarea v-model="list_text" name="pass_numbers" id="pass_numbers" cols="30" rows="5" placeholder="Введите номера в столбик или через запятую"></textarea>
            </div>
        </div>

        <button @click.prevent="do_add" >Добавить</button>
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
                    <th>Email</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, i) in list" :key="i">
                    <td>{{ item.truc_number }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.state }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script setup>
    import { ref } from 'vue'

    let list_text = ref('В228ТМ26, С739АА93, А311НО763, А741СВ763, С948ЕЕ123, Х755ОС750')
    let list = ref([])
    let loader = ref(false)

    let do_add = () => {
        loader.value = true
        list.value = []

        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n|,|, )+/g)
        console.log(mainnumbers)

        mainnumbers.forEach((elem) => {
            axios.post('/debtors_add_do', {
                'number': elem,
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
        })
    }
</script>
