<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center d-flex vh-100">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
<!--                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input v-model="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input v-model="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <a @click.prevent="logIn()" href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
<!--                                        <hr>-->
<!--                                        <a href="index.html" class="btn btn-google btn-user btn-block">-->
<!--                                            <i class="fab fa-google fa-fw"></i> Login with Google-->
<!--                                        </a>-->
<!--                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">-->
<!--                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook-->
<!--                                        </a>-->
                                    </form>
<!--                                    <hr>-->
<!--                                    <div class="text-center">-->
<!--                                        <a class="small" href="forgot-password.html">Forgot Password?</a>-->
<!--                                    </div>-->
<!--                                    <div class="text-center">-->
<!--                                        <router-link class="small" :to="{name: 'register'}">Create an Account!</router-link>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",

        data(){
            return{
                email: null,
                password: null,
            }
        },

        methods:{
            logIn(){
                    axios.post('/login', {email: this.email, password: this.password})
                        .then(r=>{
                            axios.get('/api/user')
                            .then(resp=>{
                                if(resp.data.role == '1'){
                                    this.$router.push({name: 'admin'})
                                }else{
                                    this.$router.push({name: 'home'})
                                }
                            })

                        })
            },
        },

    }
</script>

<style scoped>

</style>
