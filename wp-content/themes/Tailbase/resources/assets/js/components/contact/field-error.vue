<template>
    <span v-if="field.touched && !field.valid">
        {{ field.errorMessage }}
    </span>
</template>

<script>
export default {
    props: {
        field: {
            type: Object,
            required: true
        }
    }
}
</script>
