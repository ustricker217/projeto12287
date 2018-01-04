<template>
    <div class="wrapper">
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control" name="mail" placeholder="Email Address" required="" autofocus=""/>
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
        <button class="btn btn-lg btn-primary btn-block" v-on:click.prevent="loginUser()">Login</button>
    </div>
</template>


<script type="text/javascript">

    module.exports = {
        methods: {
            loginUser: function () {
                axios.put('api/users/' + this.user.id, this.user)
                    .then(response => {
                        // Copy object properties from response.data.data to this.user
                        // without creating a new reference
                        Object.assign(this.user, response.data.data);
                        this.$emit('user-saved', this.user)
                    });
            },

        }
    }

</script>

<style>

</style>