<template>
    <!-- <button :class="classes" @click="click(data)" title="Update">
        <span>
            <i class="fa fa-eye" aria-hidden="true"></i>
        </span>
        &nbsp;
        {{ name }}
    </button> -->
    <!-- :to="{ name: 'users.edit', params: { user: user } } -->
    <button :class="classes" @click="edit(data)">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </button>
</template>

<script>
export default {
    props: {
        data: {},
        routeName: {},
        edit: {
            type: Function,
            default: () => { }
        },
        classes: {},
    }
}
</script>