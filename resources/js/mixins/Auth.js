import store from '../store/index';


export default {

    methods: {
        can: (key) => {
            const permissions = store.getters.user.data.permissions;
            return permissions.includes(key)
        },
    },
};
