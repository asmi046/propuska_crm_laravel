<template>
    <form class="stop_spam_number_form" :action="action" method="GET">
        <InputText class="vue_field" type="text" name="truc_number" v-model="grn" placeholder="Государственный регистрационный номер" />
        <Button @click.prevent="handleSubmit" type="submit" label="СТОП!" />
    </form>
    <br>
        <svg v-show="loader" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>
</template>

<script setup>

import { ref } from 'vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'

const grn = ref('')
const loader = ref(false)
const action = ref('/stop_service_do/')

const handleSubmit = async (event) => {
    try {

        loader.value = true
        const response = await axios.get(`/stop_service_do/${grn.value}`)
        alert(' Запрос выполнен: ' + JSON.stringify(response.data))
        console.log(response.data)
    } catch (error) {
        alert('Ошибка:', error)
    } finally {
        loader.value = false
    }
}

</script>
