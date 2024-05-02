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
</template>

<script setup>
    import { ref } from 'vue'

    let list_text = ref('')

    let do_check = () => {
        let mainnumbers = list_text.value.split(/(?:\r\n|\r|\n)+/g)
    }
</script>

<style>

</style>
