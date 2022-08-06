<template>
    <button @click="handleClick" type="button" v-if="can(permission)" class=" btn btn-danger btn-sm"
        data-toggle="tooltip" data-placement="right" title="Delete" data-original-title="Delete ">
        <i class="fa fa-trash-o" aria-hidden="true"></i>
    </button>

</template>

<script>
export default {
    props: {
        permission: {
            type: String,
            require: true
        },
    },
    methods: {
        handleClick() {
            this.$emit('handleDelete');
        }
    }
}
</script>