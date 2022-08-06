<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'users.index' }">All Users</router-link>
            </li>
            <li class="active">{{ editMode ? 'Edit' : 'Add' }} User</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="d-inline-block">Add User </h4>

                            <router-link :to="{ name: 'users.index' }" v-if="can('view-users')"
                                class="d-inline-block pull-right btn btn-success text-white">All
                                User</router-link>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-d">Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.name" class="form-control" type="text"
                                                placeholder="First Name" id="name" required>
                                            <HasError :form="form" field="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-d">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.email" class="form-control" type="email"
                                                placeholder="Email" id="email" required>
                                            <HasError :form="form" field="email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label text-d">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.password" class="form-control" type="password"
                                                placeholder="Password" id="password">
                                            <HasError :form="form" field="password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label for="password_confirmation"
                                            class="col-sm-4 col-form-label text-d">Confirm
                                            Password <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input v-model="form.password_confirmation" name="password_confirmation"
                                                class="form-control" type="password" placeholder="Confirm Password"
                                                id="password_confirmation">
                                            <HasError :form="form" field="password_confirmation" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-4 col-form-label text-d">Role </label>
                                        <div class="col-sm-8">
                                            <select v-model="form.role" name="role" class="form-control" id="role"
                                                required>
                                                <option value="Admin">Admin</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Cashier">Cashier</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-4 col-form-label text-d">Status</label>
                                        <div class="col-sm-8">
                                            <select v-model="form.status" name="status" class="form-control"
                                                id="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-d">Access
                                            Locations</label>
                                        <div class="col-sm-8">
                                            <!-- <div class="mb-1">
                                                <label for="access_all_locations">
                                                    <input type="checkbox" id="access_all_location" />
                                                    All Locations
                                                </label>
                                            </div> -->
                                            <select v-model="form.location_id" id="location_id" class="form-control">
                                                <option v-for="location in locations" :value="location.id"
                                                    :key="location.id">
                                                    {{ location.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                        <Button v-if="can('create-users')" :form="form"
                                            class="btn btn-success w-md m-b-5">{{
                                                    editMode ? "Update" : "Add"
                                            }}
                                        </Button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    data: () => ({
        endPoint: '/api/users',
        users: {},
        locations: {},
        editMode: false,
        form: new Form({
            id: '',
            location_id: 1,
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            role: 'Cashier',
            status: 'Active',
        })
    }),
    methods: {
        store() {
            this.$Progress.start();
            this.form.post(this.endPoint).then(() => {
                Notification.success('User Added');
                this.$Progress.finish();
                this.$router.push({ name: 'users.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });

        },
        update() {
            this.$Progress.start();
            this.form.put(this.endPoint + '/' + this.form.id).then(() => {
                this.$Progress.finish();
                Notification.success('User Updated');
                this.$router.push({ name: 'users.index' })
            }).catch((error) => {
                this.$Progress.fail();
            });
        },
        getLocations() {
            this.$Progress.start();
            axios.get('/api/locations'
            ).then(({ data }) => {
                this.locations = data.data;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
    },
    created() {
        this.getLocations();
        if (this.$route.params.user) {
            this.form.fill(this.$route.params.user);
            this.form.location_id = this.$route.params.user.business_location.id;
            this.editMode = true;
        }
    }
}
</script>
