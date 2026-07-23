<template>
    <div class="filter-group">
        <h4>Price</h4>
        <input type="range" id="price" class="form-range" :min="subProps.minPrice" :max="subProps.maxPrice" step="1"
            v-model="localPrice">
        <div class="d-flex justify-content-between mt-2">
            <span>${{ subProps.minPrice }}</span>
            <strong>${{ localPrice }}</strong>
            <span>${{ subProps.maxPrice }}</span>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { route } from 'ziggy-js'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'


const subProps = defineProps({
    minPrice: Number,
    maxPrice: Number,
    modelValue: Number,
});

const page = usePage()
const price = ref(subProps.minPrice)

const emit = defineEmits(['update:modelValue'])

const localPrice = computed({
    get: () => subProps.modelValue,
    set: value => emit('update:modelValue', Number(value))
})


</script>