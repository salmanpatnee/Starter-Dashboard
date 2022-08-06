<template>
    <aside class="main-sidebar" v-if="authenticated">
        <!-- sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->

            <div class="user-panel text-center">
                <div class="image">
                    <img :src="'/admin/images/user.png'" class="img-circle" alt="User Image">
                </div>

                <div class="info">
                    <p>{{ user.data.name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ user.data.role }}</a>
                    <div class="branch" v-show="user.data.location_name">({{ user.data.location_name }})</div>
                </div>

            </div>

            <!-- sidebar menu -->
            <ul class="sidebar-menu">

                <li class="treeview active">
                    <router-link to="/dashboard">
                        <i class="ti-dashboard"></i> <span>Dashboard</span>
                    </router-link>
                </li>



                <!-- product menu part -->
                <li class="treeview" v-if="can('view-products')">

                    <a href="javascript:void(0)">

                        <i class="metismenu-icon fa fa-cubes"></i> <span>Product</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-categories')">
                            <router-link to="/categories">
                                Categories
                            </router-link>
                        </li>



                    </ul>

                </li>



                <!-- user menu part -->
                <li class="treeview" v-if="can('view-users')">

                    <a href="javascript:void(0)">

                        <i class="metismenu-icon fa fa-users"></i> <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-users')">
                            <router-link to="/users">
                                Manage Users
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/users/create" v-if="can('create-users')">
                                Add User
                            </router-link>
                        </li>
                    </ul>

                </li>

                <!-- user menu part -->
                <li class="treeview" v-if="can('view-settings')">

                    <a href="javascript:void(0)">

                        <i class="ti-settings"></i> <span>Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li v-if="can('view-settings')">
                            <router-link to="/settings">
                                Business
                            </router-link>
                        </li>

                    </ul>

                </li>
            </ul>
        </div> <!-- /.sidebar -->
    </aside>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'authenticated', 'user'
        ])
    }
}
</script>