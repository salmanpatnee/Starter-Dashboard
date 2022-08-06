<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Users</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Users</template>

                    <template slot="header-right">
                        <router-link :to="{ name: 'users.create' }" v-if="can('create-users')"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            User</router-link>
                    </template>
                    <template name="before-content">

                        <div class="row mb-2">
                            <div class="col-md-4 form-inline">
                                <paginate-dropdown @updatePageSize="paginate = $event" />
                            </div>
                            <div class="col-md-4 text-center">

                            </div>
                            <div class="col-md-4 form-inline text-right">
                                <search @updateSearchTerm="search = $event" />
                            </div>
                        </div>
                    </template>
                    <div class="table-responsive">
                        <table id="users_table" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" :sortOrder="sortOrder" :orderBy="orderBy"
                                @handleSort="sort($event)" />
                            <tbody>
                                <tr v-for="(user, index) in users.data" :key="user.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.role }}</td>
                                    <td>{{ user.location_name }}</td>
                                    <td>{{ user.status }}</td>
                                    <td>{{ user.joining_date }}</td>
                                    <td>{{ user.last_login }}</td>
                                    <td>
                                        <span v-if="user.id !== 1">
                                            <edit-button routeName="users.edit" :data="{ user: user }"
                                                permission="update-users" />
                                            <delete-button @handleDelete="destroy(user.id)" permission="delete-users" />
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="users" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="users" @pagination-change-page="getUsers" />
                            </div>
                        </div>
                    </template>
                </panel>
            </div>
        </div>

    </div>
</template>

<script>

import LaravelVuePagination from 'laravel-vue-pagination';

export default {

    data: () => ({
        baseEndPoint: '/api/users',
        columns: [
            {
                title: 'SL',
                name: ''
            },
            {
                title: 'Name',
                name: 'name',
                sort: true
            },
            {
                title: 'Email',
                name: 'email',
                sort: true
            },
            {
                title: 'Role',
            },
            {
                title: 'Location',
            },
            {
                title: 'Status',
            },
            {
                title: 'Joining Date',
                name: 'created_at',
                sort: true
            },
            {
                title: 'Last Login at',
                name: 'last_login',
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        users: {},
        dataLoaded: false,
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.users.meta.total;
        }
    },
    watch: {
        paginate: function ($value) {
            this.getUsers();
        },
        search: function ($value) {
            this.getUsers();
        },
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    methods: {
        getUsers(page = 1) {
            this.$Progress.start();
            axios.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.users = data;
                this.dataLoaded = true;
                this.$Progress.finish();
            }).catch(error => {
                this.dataLoaded = false;
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        sort(col) {
            this.orderBy = col;
            this.sortOrder = this.sortOrder == 'desc' ? 'asc' : 'desc';
            this.getUsers();
        },
        async destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                this.$Progress.start();
                if (result.isConfirmed) {
                    const originalUsers = this.users.data;

                    this.users.data = this.users.data.filter(user => user.id != id);
                    axios.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('User Deleted.');
                        this.$Progress.finish();
                    }).catch((error) => {
                        this.users.data = originalUsers;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                    });
                }
            })
        },
    },
    mounted() {
        this.getUsers();
    }
}
</script>
