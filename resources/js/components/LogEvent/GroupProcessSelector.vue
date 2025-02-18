<template>

    <div class="group_process ">
        <p class="mb10"><strong>С выделенными:</strong></p>
        <div class="control">
            <Dropdown :disabled="props.selected == undefined || props.selected.length == 0" v-model="action" placeholder="Выберите действие" :options="actionList" optionLabel="name" />
            <Button :disabled="action == ''"  @click.prevent="actionHandler" label="Выполнить" icon="pi pi-check" />
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
})



var loading = ref(false);
var action = ref('');
const actionList = [
    { name: "Присвоить статус: Непрочитанное", code: "Непрочитанное" },
    { name: "Присвоить статус: Прочитанное", code: "Прочитанное" },
    { name: "Присвоить статус: Важное", code: "Важное" },
];

const actionHandler = () => {
    console.log(props.selected)
    loading.value = true
    var idList = [];
    for (var i = 0; i < props.selected.length; i++) {
        idList.push(props.selected[i].id);
    }

    axios.post('/set_event_state', {
        state: action.value.code,
        list: idList
    })
    .then((resp) => {
        loading.value = false

        for (var i = 0; i < props.selected.length; i++)
            props.selected[i].state = action.value.code;

        console.log(resp.data)
        action.value = ''


    })
    .catch(error => {
        loading.value = false
        console.log(error)
    });
}

</script>

