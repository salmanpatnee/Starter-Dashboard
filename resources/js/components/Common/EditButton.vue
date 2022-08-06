<template>
    <router-link 
    :to="{ name: routeName, params: data }" 
    v-if="can(permission)" 
    class="btn btn-info btn-sm" 
    data-toggle="tooltip" 
    data-placement="left" 
    title="Update" 
    data-original-title="Update">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </router-link>
</template>

<script>
export default {
    props: {
        routeName: {
            type: String,
            require: true
        },
        data: {
            type: Object,
            require: true
        }, 
        permission: {
            type: String,
            require: true
        },
    }
}
</script>