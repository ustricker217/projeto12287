<template>
    <div class="wrapper form-signin">
        <h2 class="form-signin-heading">Register</h2>

        <div class="form-group">
            <label for="inputName">Name</label>
            <input
                    type="text" class="form-control" v-model="name"
                    name="name" id="inputName"
                    placeholder="Fullname"/>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input
                    type="email" class="form-control" v-model="email"
                    name="email" id="inputEmail"
                    placeholder="Email address"/>
        </div>
        <div class="form-group">
            <label for="inputNickname">Nickname</label>
            <input
                    type="text" class="form-control" v-model="nickname"
                    name="nickname" id="inputNickname"
                    placeholder="Your Nickname"/>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input
                    type="password" class="form-control" v-model="password"
                    name="age" id="inputPassword"
                    placeholder="Password"/>
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword">Confirm Password</label>
            <input
                    type="password" class="form-control" v-model="confirm_password"
                    name="age" id="inputConfirmPassword"
                    placeholder="Confirm Password"/>
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
    module.exports={
        //props: ['users'],
        data: function(){
            return {
                username: '',
                nickname: '',
                mail: '',
                password: '',
                confirm_password: '',
                showSuccess: false,
                successMessage: '',
            }
        },
        methods: {
            registerUser: function () {
                axios.post('api/register', {
                    'name': this.name,
                    'nicknname': this.nickname,
                    'email': this.username,
                    'password': this.password,
                    'confirm_password': this.confirm_password,

                    contentType: 'application/json',
                })
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = response.data.msg;
                        this.$emit('user-logged', false);
                        //this.$route.router.go('/multimemory');
                        this.$router.push('/');
                    })
                    .catch(error => {
                        this.showSuccess = true;
                        this.successMessage = error.data.msg;
                        console.log(this.password);
                    });
            },
        }
    }

</script>

<style>

</style>