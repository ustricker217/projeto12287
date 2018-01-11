<template>
    <div class="wrapper form-signin">
        <button type="btn btn-default" class="btn-primary" v-on:click="goToRegister()">Register</button>
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control" name="mail" placeholder="Email Address" required="" autofocus=""
               v-model="username"/>
        <input type="password" class="form-control" name="password" placeholder="Password" required=""
               v-model="password"/>
        <button class="btn btn-lg btn-primary btn-block" v-on:click.prevent="loginUser()">Login
        </button>
        <div class="alert alert-success" v-if="showSuccess">

            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>
</template>


<script type="text/javascript">

    module.exports = {
        data: function () {
            return {
                username: '',
                password: '',
                showSuccess: false,
                successMessage: '',
            }
        },
        methods: {
            loginUser: function () {
                axios.post('api/login', {
                    'password': this.password,
                    'email': this.username,
                    contentType: 'application/json',
                })
                    .then(response => {
                        //console.log(response);
                        this.showSuccess = true;
                        this.successMessage = "User succesfully logged";
                        this.$emit('user-logged', [this.username, response.data.access_token]);
                        this.$router.push('/');
                    })
                    .catch(error => {
                        this.showSuccess = true;
                        this.successMessage = error.data.msg;
                        console.log(this.password);
                    });
            },

            goToRegister: function () {
                this.$router.push('/register');
            },
        }
    }

</script>

<style>

</style>