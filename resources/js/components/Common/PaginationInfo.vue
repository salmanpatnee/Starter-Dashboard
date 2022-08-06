<template>
    <p v-if="data.meta" class="text-start">Showing {{ data.meta.current_page }} to {{ data.meta.last_page }}
        of {{ data.meta.total }} record(s)</p>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            require: true
        },
    }

}
</script>