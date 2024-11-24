<template>
    <Toast />
    <Sidebar v-model:visible="showModal" v-model:header="winHeader" position="full">
        <div class="flex flex-column gap-2">
            <label for="username">Тема письма</label>
            <InputText id="username" v-model="winSubj" aria-describedby="username-help" />
        </div>
        <br>
        <div class="flex flex-column gap-2">
            <label for="username">Текст письма</label>
            <Editor  ref="mEditor" v-model="winText" editorStyle="height: 320px" />
        </div>
        <br>
        <br>
        <p>[truc_number] - номер грузовика</p>
        <p>[pass] - серия и номер пропуска в формате БА1749390 (для экстренного оповещения)</p>
        <p>[time] - время пропуска Дневной/Ночной (для экстренного оповещения)</p>
        <p>[cancel_date] - дата аннуляции</p>
        <p>[valid_from] - дата начала</p>
        <p>[valid_to] - дата окончания</p>
        <p>[series] - серия пропуска</p>
        <p>[pass_number] - номер пропуска</p>
        <p>[type_pass] - время пропуска Дневной/Ночной (для остальных шаблонов)</p>
        <p>[pass_zone] - зона пропуска</p>
        <br>
        <br>
        <Button label="Сохранить" @click.prevent="updatedTemplate"/>
    </Sidebar>



    <DataTable v-if="list.length != 0" stripedRows :value="list">
        <Column field="name" header="Имя"></Column>
        <Column field="subj" header="Тема"></Column>
        <Column field="slug" header="Идентификатор"></Column>

        <Column field="state" header="Управление">
            <template  #body="{ index }">
                <Button icon="pi pi-wrench" aria-label="Редактировать" @click.prevent="openEditWin(index)" />
            </template>
        </Column>

    </DataTable>
    <div  v-else>
        <strong v-if="loading">Загружаем шаблоны...</strong>
        <strong v-else>Должников нет в базе</strong>
    </div>

</template>

<script setup>
import DataTable from 'primevue/datatable'
import Toast from 'primevue/toast';
import Column from 'primevue/column'
import Button from 'primevue/button'
import Sidebar from 'primevue/sidebar';
import InputText from 'primevue/inputtext';
import Editor from 'primevue/editor';
import { useToast } from 'primevue/usetoast';
import { ref, watch } from 'vue';

const toast = useToast();

let list = ref([])
let loading = ref(false)
let showModal = ref(false)
let itemId = ref("")
let winSubj = ref("")
let winText = ref('sdf1df')
let winHeader  = ref("Заголовок")

let mEditor = ref(null)

const props = defineProps({
  action: String,
})

watch(mEditor, (editor) => {
  if (!editor) return

  editor.renderValue = function renderValue(value) {
    if (this.quill) {
      if (value) {
        const delta = this.quill.clipboard.convert({ html: value })
        this.quill.setContents(delta, 'silent')
      } else {
        this.quill.setText('')
      }
    }
  }.bind(editor)
})

const getDebtorsList = () => {
    loading.value = true
    axios.get(props.action)
            .then((resp) => {
                console.log(resp.data)

                loading.value = false
                list.value = resp.data;
            })
            .catch(error => {
                loading.value = false
                console.log(error)
            });
}

const openEditWin = (index) => {
    showModal.value = true
    winHeader.value = "Шаблон: "+list.value[index].name
    itemId.value = list.value[index].id
    winText.value = list.value[index].text
    winSubj.value = list.value[index].subj
    console.log(list.value[index].text)
}


const updatedTemplate = () => {
    toast.add({ severity: 'info', summary: 'Процесс...', detail: 'Сохраняем шаблон...', life: 3000 });
    axios.post("/email_template_update", {
        id: itemId.value,
        subj: winSubj.value,
        text: winText.value,
    })
            .then((resp) => {
                toast.add({ severity: 'success', summary: 'Успех', detail: 'Запись обновлена', life: 3000 });
                loading.value = false
            })
            .catch(error => {
                loading.value = false;
                toast.add({ severity: 'error', summary: 'Ошибка', detail: error.message, life: 3000 });
            });
}

getDebtorsList()

</script>
