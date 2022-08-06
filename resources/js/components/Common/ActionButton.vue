<template>
    <button v-if="can(permission)" @click="handleClick" class="btn" :class="classes" data-toggle="tooltip"
        data-placement="left" :title="label" :data-original-title="label">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        classes: {
            type: String,
        },
        label: {
            type: String,
            require: true
        },
        permission: {
            type: String,
            require: true
        },
    },
    methods: {
        handleClick() {
            this.$emit('action')
        }
    }
}
</script>