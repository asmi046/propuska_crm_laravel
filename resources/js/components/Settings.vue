<template>
    <div v-show="show_settings" class="sb_wrapper">
        <InputSwitch  v-model="checked" />
        <p>Отправка оповещений по API</p>
    </div>

</template>

<script setup>

    import InputSwitch from 'primevue/inputswitch';
    import { ref, watch } from 'vue'
    let checked = ref(true)
    let show_settings = ref(false)

    watch(checked, (newVal, oldVal) => {
        axios.post('/send_api_meaasge_set/'+newVal, {
            '_token': document.querySelector('meta[name="_token"]').content
        })
        .catch(error => {
            console.log(error)
        });
    })

    axios.get('/send_api_meaasge_get')
            .then((resp) => {
                checked.value = resp.data.send_api_meaasge
                show_settings.value = true
            })
            .catch(error => {
                console.log(error)
            });

</script>

<style lang="scss">
.sb_wrapper {
        display: flex;
        margin: 30px auto;
        p {
            margin: auto auto auto 20px;
        }
}

</style>

