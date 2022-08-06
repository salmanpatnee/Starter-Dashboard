<template>
    <div class="form-group">
        <label :for="name">Search: </label>
        <input @change="handleInput" v-model.trim.lazy="search" type="search" id="name" class="form-control">
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            default: "search"
        }
    },
    data() {
        return {
            search: '',
        };
    },
    methods: {
        handleInput() {
            this.$emit('updateSearchTerm', this.search)
        }
    }
}
</script>