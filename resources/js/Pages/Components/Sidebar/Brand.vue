<template>
    <div class="filter-group">
        <h4>Brands</h4>
        <div v-for="brand in brands" :key="brand" class="form-check">
            <input class="form-check-input" type="checkbox" :value="brand.id"
                @change="toggleBrand(brand.id, $event.target.checked)">
            <label class="form-check-label">{{ brand.name }}</label>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    brands: Array,
    modelValue: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(['update:modelValue']);

function toggleBrand(id, checked) {
    let values = [...props.modelValue];

    if (checked) {
        values.push(id)
    } else {
        values = values.filter(item => item !== id)
    }

    emit('update:modelValue', values);
}


</script>