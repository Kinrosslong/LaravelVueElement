<template>
   <form class="form-horizontal" method="POST" @submit.prevent="login">

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">邮箱</label>
            <div class="col-md-6">
                <input v-model="email" id="email" type="email" class="form-control" name="email" v required>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">密码</label>
            <div class="col-md-6">
                <input v-model="password" id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    登陆
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import JWTToken from './../helpers/jwt'
    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            login() {
                let formData = {
                    // client_id: 2,
                    // client_secret: '9gpkjkcipCZ54RUrWG3yRa448nukFtDmu9MuGex9',
                    // grant_type: 'password',
                    email: this.email,
                    password: this.password,
                    scope: '',
                }
                axios.post('/api/login', formData).then(res => {
                    
                    JWTToken.setToken(res.data.token);
                    console.log(res.data);
                    console.log(789);
                }).catch(error => {
                    comsole.log(error.res.responee.data);
                })
            }
        }
    }
</script>