<template>
    <SplitButton label="Подробнее" @click="more" :model="items" raised></SplitButton>
</template>

<script setup>
    import SplitButton from 'primevue/splitbutton';

    const props = defineProps({
        id: Number,
        gn: String
    })

    const items = [
        {
            label: 'Редактировать',
            icon: 'pi pi-pen-to-square',
            command: () => {
                window.location.href = "/edit_number_info/"+props.id
            }
        },

        {
            label: 'Удалить',
            icon: 'pi pi-times',
            command: () => {
                window.location.href = "/delete_number/"+props.id
            }
        },
        // { label: 'Upload', to: '/fileupload' }
    ];

    const more = () => {
        window.location.href = '/check_number/'+props.gn;
    };
</script>
