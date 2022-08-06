<template>
    <thead>
        <tr>
            <th v-for="(column, index) in columns" :key="index">
                <span v-if="!column.sort" v-text="column.title"></span>
                <span v-else>
                    <a href="" @click.prevent="handleClick(column.name)" v-text="column.title"></a>
                    <span v-show="sortOrder == 'desc' && orderBy == column.name">&uarr;</span>
                    <span v-show="sortOrder == 'asc' && orderBy == column.name">&darr;</span>
                </span>

            </th>
        </tr>
    </thead>
</template>

<script>
export default {
    props: {
        columns: {
            type: Array,
            require: true
        },
        sortOrder: {
            type: String,
        },
        orderBy: {
            type: String,
        }
    },
    methods: {
        handleClick(column) {
            this.$emit('handleSort', column)
        }
    }
}
</script>