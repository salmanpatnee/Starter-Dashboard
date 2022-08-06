<template>
    <div class="form-group">
        <label :for="name">Show: </label>
        <select @change="handleChange" v-model="paginate" :id="name" class="form-control">
            <option v-for="item in items" :key="item" :value="item">{{
                    item
            }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            default: "paginate"
        },
        items: {
            type: Array,

            default: function () {
                return [10, 25, 50, 100, 250, 500]
            }
        },
        pageSize: {
            type: Number,
            default: 10
        }
    },
    data() {
        return {
            paginate: this.pageSize,
        };
    },
    methods: {
        handleChange() {
            this.$emit('updatePageSize', this.paginate)
        }
    }
}
</script>