<template>
    <div class="an_wrapper">
        <div v-for="pass in props.item" :key="pass.number" class="an" :class="pass.sys_color">
            <div class="b_head">
                <svg v-if="pass.type_pass == 'Дневной'" class="time_icon"><use xlink:href="#sun"></use></svg>
                <svg v-else class="time_icon"><use xlink:href="#moon"></use></svg>
                <span>{{ pass.type_pass }}</span>
            </div>

            <div class="b_body">
                <span>{{ pass.sys_status }}</span>
                <span>{{ pass.pass_zone }}</span>
                <span>{{ pass.series }}-{{ pass.pass_number }}</span>
                <span>от {{ pass.valid_from }}</span>
                <span>до {{ pass.valid_to }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        item: Object
    })
</script>
