<template>
    <div>
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Categories</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Manage Categories</template>

                    <template slot="header-right">
                        <button v-if="can('create-categories')" @click="create"
                            class="d-inline-block pull-right btn btn-success text-white">Add
                            Category</button>
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
                        <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                            <table-header :columns="columns" :sortOrder="sortOrder" :orderBy="orderBy"
                                @handleSort="sort($event)" />
                            <tbody>

                                <tr v-for="category in categories.data" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>
                                        <action-button @action="edit(category)" class='btn-sm btn-info'
                                            permission="update-categories" label="Update">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </action-button>
                                        <span v-if="category.id !== 1">
                                            <delete-button @handleDelete="destroy(category.id)"
                                                permission="delete-categories" />
                                        </span>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <template name="footer">
                        <div class="row">
                            <div class="col-md-6">
                                <pagination-info :data="categories" />
                            </div>
                            <div class="col-md-6 text-right">
                                <Pagination :data="categories" @pagination-change-page="getCategories" />
                            </div>
                        </div>
                    </template>
                </panel>
            </div>
        </div>
        <div class="modal fade modal-success" id="category_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-vertical" @submit.prevent="editMode ? update() : store()"
                        @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h4 class="modal-title">
                                {{ editMode ? "Update" : "Add" }} Category
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div id="customeMessage" class="alert hide"></div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        Category Name <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <input v-model="form.name" class="form-control" name="name" id="name"
                                            type="text" placeholder="Category Name" tabindex="1" required>
                                        <HasError :form="form" field="name" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" tabindex="5" data-dismiss="modal">Close</a>
                            <button type="submit" tabindex="6" class="btn btn-success" :disabled="form.busy">
                                {{ editMode ? "Update" : "Save" }}
                            </button>
                        </div>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';
export default {

    data: () => ({
        modal: "#category_modal",
        baseEndPoint: '/api/categories',
        categories: {},
        columns: [
            {
                title: 'SL',
                name: ''
            },
            {
                title: 'Category Name',
                name: 'name',
                sort: true
            },
            {
                title: 'Action',
                name: '',
            }
        ],
        dataLoaded: false,
        editMode: false,
        form: new Form({
            id: '',
            name: '',
        }),
        orderBy: 'created_at',
        paginate: 10,
        search: '',
        sortOrder: 'desc',
    }),
    computed: {
        total() {
            return this.categories.meta.total;
        }
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    watch: {
        paginate: function ($value) {
            this.getCategories();
        },
        search: function ($value) {
            this.getCategories();
        },
    },
    methods: {
        getCategories(page = 1) {
            this.$Progress.start();
            this.form.get(this.baseEndPoint
                + '?page=' + page
                + '&paginate=' + this.paginate
                + '&search=' + this.search
                + '&sortOrder=' + this.sortOrder
                + '&orderBy=' + this.orderBy
            ).then(({ data }) => {
                this.categories = data;
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
            this.getCategories();
        },
        create() {
            this.resetModal();
        },
        store() {
            this.$Progress.start();
            this.form.post(this.baseEndPoint).then(() => {
                Fire.$emit('refreshCategories');

                $(this.modal).modal('hide');
                Notification.success('Category Added');
                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());

        },
        edit(category) {
            this.resetModal(true);
            this.form.fill(category);
        },
        update() {
            this.$Progress.start();
            this.form.put(this.baseEndPoint + '/' + this.form.id).then(() => {
                Fire.$emit('refreshCategories');

                $(this.modal).modal('hide');
                Notification.success('Category Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
        destroy(id) {

            Swal.fire(Notification.confirmDialogAtts()).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    const originalCategories = this.categories.data;

                    this.categories.data = this.categories.data.filter(category => category.id != id);

                    this.form.delete(this.baseEndPoint + '/' + id).then(() => {

                        Notification.success('Category Deleted');

                        Fire.$emit('refreshCategories');

                        this.$Progress.finish();
                    }).catch((error) => {
                        this.categories.data = originalCategories;
                        this.$Progress.fail();
                        Notification.error('Unexpected error occurred.');
                        console.log('Error', error);
                    });
                }
            })
        },
        resetModal(mode = false) {
            this.editMode = mode;
            this.form.reset();
            $(this.modal).modal('show');
        },
    },
    created() {
        this.getCategories();
        Fire.$on('refreshCategories', () => {
            this.getCategories();
        });
    }
}
</script>
