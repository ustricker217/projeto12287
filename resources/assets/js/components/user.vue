<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
        <div>
            <user-login @user-logged="getLoggedUser"></user-login>
        </div>
        <div class="alert alert-success" v-if="showSuccess">

            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>
</template>

<script type="text/javascript">
    import UserLogin from './userLogin.vue';
    import UserEdit from './userEdit.vue';

    export default {
        data: function () {
            return {
                title: 'User',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                username: '',
                password: '',
                ifLogged: false,
            }
        },
        methods: {
            editUser: function (user) {
                this.currentUser = user;
                this.showSuccess = false;
            },
            deleteUser: function (user) {
                axios.delete('api/users/' + user.id)
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = 'User Deleted';
                        this.getUsers();
                    });
            },
            savedUser: function () {
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = true;
                this.successMessage = 'User Saved';
            },
            cancelEdit: function () {
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = false;
            },

            getLoggedUser: function (flag) {
                this.ifLogged = flag;

            }
        },
        components: {
            'user-login': UserLogin,
            'user-edit': UserEdit
        },
        mounted() {

        }

    }
</script>

<style scoped>
    p {
        font-size: 2em;
        text-align: center;
    }
</style>