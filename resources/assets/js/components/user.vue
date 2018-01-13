<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
        <div>
            <div v-if="ifLogged == true">
                <button type="btn btn-default" class="btn-primary" v-on:click="goToEdit()">Edit User</button>
                <button type="btn btn-default" class="btn-primary" v-on:click="goToSinglePlayer()">Singleplayer</button>
                <button type="btn btn-default" class="btn-primary" v-on:click="goToMultiplayer()">Multiplayer</button>
                <button type="btn btn-default" class="btn-primary" v-on:click="logout()">Logout</button>
            </div>

            <div v-if="ifLogged == false">
                <user-login @user-logged="getLoggedUser"></user-login>
            </div>

            <div v-if="ifEditing && ifLogged">
                <user-edit :currentUser="currentUser" @user-canceled="cancelEdit" @user-saved="savedUser"></user-edit>
            </div>

            <div v-if="playSingle && ifLogged">
                <single-player :currentUser="currentUser"></single-player>
            </div>

            <div v-if="playMulti && ifLogged">
                <multi-player :currentUser="currentUser.name" :userId="currentUser.id"></multi-player>
            </div>

            <router-view></router-view>
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
    import SinglePlayer from './singleplayer_memory.vue';
    import MultiPlayer from './multiplayer_memory.vue';


    export default {
        data: function () {
            return {
                title: 'Jogo da Memoria',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                username: null,
                userToken: null,
                ifLogged: false,
                ifEditing: false,
                playSingle: false,
                playMulti: false,
            }
        },
        methods: {
            editUser: function (user) {
                this.currentUser = user;
                this.showSuccess = false;
            },
            savedUser: function (user) {
                this.currentUser = user;
                //this.$refs.usersListRef.editingUser = null;
                this.showSuccess = true;
                this.successMessage = 'User Saved';
                this.ifEditing = false;
            },
            cancelEdit: function () {
                //this.$refs.usersListRef.editingUser = null;
                //this.showSuccess = false;
                this.ifEditing = false;
            },

            getLoggedUser: function (array) {
                //console.log(array);
                this.ifLogged = true;
                this.username = array[0];
                this.userToken = array[1];
                sessionStorage.setItem('token-user', array[1]);
                sessionStorage.setItem('username', array[0]);


                axios.get('api/getLoggedUser/' + this.username)
                    .then(response => {
                        //console.log(response.data.data);
                        this.currentUser = response.data.data;
                        console.log(this.currentUser);
                    })
                    .catch(errors => {

                    })
            },

            logout: function () {
                //NAO FOI POSSIVEL FAZER AXIOS.POST PARA LOGOUT (DA SEMPRE ERRO)
                sessionStorage.clear();
                this.ifLogged = false;
                this.currentUser = null;
                this.username = null;
                this.userToken = null;
            },

            goToSinglePlayer: function () {
                //this.$router.push('/singleplayer');
                this.playSingle = true;
                this.ifEditing = false;
            },

            goToMultiplayer: function () {
                //this.$router.push('/multiplayer');
                this.playSingle = false;
                this.ifEditing = false;
                this.playMulti = true;
            },

            fillSession: function () {
                this.username = sessionStorage.getItem('username');
                this.userToken = sessionStorage.getItem('token-user');

                if (this.username == null && this.userToken == null) {
                    this.ifLogged = false;
                } else {
                    axios.get('api/getLoggedUser/' + this.username)
                        .then(response => {
                            //console.log(response.data.data);
                            this.currentUser = response.data.data;
                            console.log(this.currentUser);
                        })
                        .catch(errors => {

                        });

                    this.ifLogged = true;
                }
            },

            goToEdit: function () {
                this.ifEditing = true;
                //this.$router.push('/edit');
            },

        },
        components: {
            SinglePlayer,
            'user-login': UserLogin,
            'user-edit': UserEdit,
            'single-player': SinglePlayer,
            'multi-player': MultiPlayer,
        },
        mounted() {
            this.fillSession();
        }

    }
</script>

<style scoped>
    p {
        font-size: 2em;
        text-align: center;
    }
</style>