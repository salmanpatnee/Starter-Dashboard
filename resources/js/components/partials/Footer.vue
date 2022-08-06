<template>
    <!-- Footer -->
    <footer v-if="authenticated" class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>copyright &copy; 2022 - developed by
                    <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                </span>
            </div>
        </div>
    </footer>
    <!-- Footer -->
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