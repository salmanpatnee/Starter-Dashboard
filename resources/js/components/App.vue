<template>
    <div class="d-flex w-100">
        <Sidebar></Sidebar>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <Header></Header>
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 text-capitalize">{{ displayCurrentPageTitle }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active text-capitalize" aria-current="page">{{
                                    displayCurrentPageTitle
                            }}</li>
                        </ol>
                    </div>
                    <router-view></router-view>
                    <!-- set progressbar -->
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div> <!-- /.content -->
            <Footer></Footer>
        </div> <!-- /.content-wrapper -->
    </div>
</template>

<script>
import Header from './partials/Header';
import Sidebar from './partials/Sidebar';
import Footer from './partials/Footer';
export default {
    data() {
        return {
            currentPage: ''
        }
    },
    computed: {
        displayCurrentPageTitle() {
            return this.currentPage.replace('/', '');
        }
    },
    components: {
        Header, Sidebar, Footer
    },
    mounted() {
        this.currentPage = this.$router.currentRoute.fullPath;
    }
}
</script>
