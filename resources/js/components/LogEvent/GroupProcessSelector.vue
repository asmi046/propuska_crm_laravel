<template>

    <div class="group_process ">
        <p class="mb10"><strong>С выделенными:</strong></p>
        <div class="control">
            <!-- <Dropdown :disabled="props.selected == undefined || props.selected.length == 0" v-model="action" placeholder="Выберите действие" :options="actionList" optionLabel="name" />
            <Button :disabled="action == ''"  @click.prevent="actionHandler" label="Выполнить" icon="pi pi-check" /> -->

            <Button :disabled="props.selected == undefined || props.selected.length == 0" @click.prevent="actionHandler('Непрочитанное')" icon="pi pi-question-circle" severity="secondary" aria-label="Не прочитано" label="Не прочитано"  />
            <Button :disabled="props.selected == undefined || props.selected.length == 0" @click.prevent="actionHandler('Прочитанное')" icon="pi pi-plus-circle" severity="success" aria-label="Прочитано" label="Прочитано" />
            <Button :disabled="props.selected == undefined || props.selected.length == 0" @click.prevent="actionHandler('Важное')" icon="pi pi-megaphone" severity="danger" aria-label="Важное" label="Важное"  />
            <ProgressBar v-show="loading" mode="indeterminate" style="height: 6px; width: 50px;"></ProgressBar>
        </div>
    </div>

</template>

<script setup>
import { ref } from 'vue';

import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import ProgressBar from 'primevue/progressbar';

const props = defineProps({
    selected: Array,
    callback: Function,
})



var loading = ref(false);


const actionHandler = (state) => {
    console.log(props.selected)
    loading.value = true
    var idList = [];
    for (var i = 0; i < props.selected.length; i++) {
        idList.push(props.selected[i].id);
    }

    axios.post('/set_event_state', {
        state: state,
        list: idList
    })
    .then((resp) => {
        loading.value = false

        for (var i = 0; i < props.selected.length; i++)
            props.selected[i].state = state;

        if (props.callback )
            props.callback()

        console.log(resp.data)
    })
    .catch(error => {
        loading.value = false
        console.log(error)
    });
}

</script>

