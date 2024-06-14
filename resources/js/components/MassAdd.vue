<template>
    <label class="file" for="i_file">
        <svg class="sprite_icon">
            <use xlink:href="#file"></use>
        </svg>
        <p v-if="!file_loadet">Выберите файл...</p>
        <p v-else>{{file_name}}</p>
        <input @change="chengeFile" id="i_file" type="file" accept="text/csv">
    </label>

    <Fieldset legend="Результаты">
        <p><strong>Загружено из файла:</strong> {{ file_count }}</p>
        <p><strong>Добавлено в базу:</strong> {{ in_base_count }}</p>
    </Fieldset>

    <br>
    <Button @click.prevent="addToBase" label="Добавить в базу" />

    <br>
        <svg v-show="loader" class="loader_icon">
            <use xlink:href="#loader"></use>
        </svg>
    <br>

    <div v-show="list.length > 0" class="table_wrapper">
        <DataTable stripedRows  :value="list">
            <Column field="truc_number" header="Госномер"></Column>
            <Column field="email" header="e-mail"></Column>
            <Column field="state" header="Статус">
                <template #body="slotProps">
                    <Tag v-if="slotProps.data.state && slotProps.data.state == 'Добавлен в базу'" icon="pi pi-check" severity="success" :value="slotProps.data.state" />
                    <Tag v-if="slotProps.data.state && slotProps.data.state == 'Уже в базе'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
                    <Tag v-if="slotProps.data.state && slotProps.data.state == 'Ошибка'" icon="pi pi-times" severity="danger" :value="slotProps.data.state" />
                    <Tag v-if="slotProps.data.state && slotProps.data.state == 'Ожидает загрузки'" icon="pi pi-info-circle" severity="info" :value="slotProps.data.state" />
                </template>
            </Column>
        </DataTable>
    </div>



</template>

<script setup>
    import { ref } from 'vue'
    import * as papa from "papaparse"
    import Fieldset from 'primevue/fieldset';
    import Button from 'primevue/button';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Tag from 'primevue/tag';

    let file_loadet = ref(false)
    let file_name = ref('')
    let list = ref([])

    let file_count = ref(0)
    let in_base_count = ref(0)
    let obr_count = ref(0)

    let loader = ref(false)

    const addToBase = (e) => {
        if (list.value.length == 0) {
            alert('Номера не загружены!');
            return
        }

        loader.value = true

        list.value.forEach((element) => {
            axios.post('/add_many_numbers_line', {
                'truc_number': element.truc_number,
                'email': element.email,
            })
            .then((resp) => {
                element.state = resp.data.state
                obr_count.value = obr_count.value + 1

                if (resp.data.state == "Добавлен в базу") in_base_count.value += 1

                if (obr_count.value == list.value.length)
                    loader.value = false
            })
            .catch((error) => {
                console.log(error)
                element.state = "Ошибка"
                obr_count.value = obr_count.value + 1
            });
        })

    }

    const chengeFile = (e) => {
        let files = e.target.files || e.dataTransfer.files;
        file_loadet.value = (files[0].name != "")?true:false;

        if (files[0]) {
            loader.value = true
            file_name.value = files[0].name
            console.log(files[0]);

            papa.parse(files[0], {
                delimiter: ";",
                newline: "\r\n",
                encoding: "WINDOWS-1251",
                complete: (results) => {
                    file_count.value = results.data.length
                    for (let i = 0; i < results.data.length; i++) {
                        if (results.data[i][0] == "") continue
                        list.value.push({
                            "truc_number": results.data[i][0],
                            "email": results.data[i][1],
                            "state": "Ожидает загрузки",
                        });
                    }

                    loader.value = false
                }
            })
        }
    }
</script>

<style>

</style>
