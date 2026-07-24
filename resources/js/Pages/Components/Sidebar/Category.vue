<template>
    <div class="filter-group">
        <h4>Categories</h4>
        <div v-for="category in categories" :key="category" class="form-check">

            <input class="form-check-input" type="checkbox" :value="category.id"
                @change="toggleCategory(category.id, $event.target.checked)">

            <label class=" form-check-label">{{ category.name }}</label>
        </div>
    </div>
    <p></p>
</template>

<script setup>

const props = defineProps({
    categories: Array,
    modelValue: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(['update:modelValue'])

function toggleCategory(id, checked) {
    let values = [...props.modelValue]

    if (checked) {
        values.push(id)
    } else {
        values = values.filter(item => item !== id)
    }

    emit('update:modelValue', values)
}

</script>