<template>
    <div class="wrapper form-signin">
        <h2 class="form-signin-heading">Register</h2>

        <div class="form-group">
            <label for="inputName">Name</label>
            <input
                    type="text" class="form-control" v-model="username"
                    name="name" id="inputName"
                    placeholder="Fullname" required/>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input
                    type="email" class="form-control" v-model="mail"
                    name="email" id="inputEmail"
                    placeholder="Email address" required/>
        </div>
        <div class="form-group">
            <label for="inputNickname">Nickname</label>
            <input
                    type="text" class="form-control" v-model="nickname"
                    name="nickname" id="inputNickname"
                    placeholder="Your Nickname" required/>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" v-model="password"
                   name="password" id="inputPassword"
                   placeholder="Password" required/>
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword">Confirm Password</label>
            <input
                    type="password" class="form-control" v-model="confirm_password"
                    name="confirm_password" id="inputConfirmPassword"
                    placeholder="Confirm Password" required/>
        </div>

        <button class="btn btn-lg btn-primary btn-block" v-on:click.prevent="registerUser()">Register
        </button>
        <div class="alert alert-success" v-if="showSuccess">

            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>
</template>

<script type="text/javascript">
    module.exports = {
        //props: ['users'],
        data: function () {
            return {
                username: null,
                nickname: null,
                mail: null,
                password: null,
                confirm_password: null,
                showSuccess: false,
                successMessage: '',
            }
        },
        methods: {
            registerUser: function () {
                if (this.username == null || this.nickname == null || this.mail == null) {
                    this.showSuccess = true;
                    this.successMessage = "All feilds are required";
                } else if (this.password != this.confirm_password) {

                    this.showSuccess = true;
                    this.successMessage = "Password and Confirm Password are different";

                } else {
                    axios.post('api/register', {
                        'name': this.username,
                        'nickname': this.nickname,
                        'email': this.mail,
                        'password': this.password,
                        //'confirm_password': this.confirm_password,

                        contentType: 'application/json',
                    })
                        .then(response => {
                            this.showSuccess = true;
                            this.successMessage = response.data.msg;
                            //this.$emit('user-logged', false);
                            //this.$route.router.go('/multimemory');
                            this.$router.push('/');
                        })
                        .catch(error => {
                            //error.data.msg = "All fields are required";
                            //this.showSuccess = true;
                            //this.successMessage = error.data.msg;
                            console.log(this.password);
                        });
                }

            },
        }
    }

</script>

<style>

</style>
