<template>
    <div class="jumbotron">
        <h2 class="form-signin-heading">Edit</h2>

        <div class="form-group">
            <label for="inputName">Name</label>
            <input
                    type="text" class="form-control" v-model="currentUser.name"
                    name="name" id="inputName"
                    placeholder="Fullname"/>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input
                    type="email" class="form-control" v-model="currentUser.email"
                    name="email" id="inputEmail"
                    placeholder="Email address"/>
        </div>
        <div class="form-group">
            <label for="inputNickname">Nickname</label>
            <input
                    type="text" class="form-control" v-model="currentUser.nickname"
                    name="nickname" id="inputNickname"
                    placeholder="Your Nickname"/>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input
                    type="password" class="form-control" v-model="currentUser.password"
                    name="age" id="inputPassword"
                    placeholder="Password"/>
        </div>

        <div class="form-group">
            <a class="btn btn-default" v-on:click.prevent="saveUser()">Save</a>
            <a class="btn btn-default" v-on:click.prevent="cancelEdit()">Cancel</a>
        </div>
    </div>
</template>

<script type="text/javascript">
    module.exports = {
        props: ['currentUser'],
        methods: {
            saveUser: function () {
                axios.put('api/users/' + this.currentUser.id, this.currentUser)
                    .then(response => {
                        Object.assign(this.currentUser, response.data.data);
                        this.$emit('user-saved', this.currentUser)
                    });
            },
            cancelEdit: function () {
                this.$emit('user-canceled');
            }
        },
        mounted() {
            //console.log(this.currentUser);
        }
    }
</script>

<style scoped>

</style>