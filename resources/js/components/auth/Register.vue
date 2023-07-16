<template>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
<!--                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input v-model="name" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input v-model="email" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input v-model="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input v-model="password_confirmation" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <a @click.prevent="registerAcc()" href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
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
        name: "Register",

        data(){
            return{
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        },
        mounted(){

        },

        methods:{
            registerAcc()
            {
                axios.get('sanctum/csrf-cookie')
                .then(r=>{
                    axios.post('/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    }).then(resp=>{
                        axios.get('/api/user').then(response=>{
                            if(response.data.role == '1'){
                                this.$router.push({name: 'admin'})
                            }else{
                                this.$router.push({name: 'home'})
                            }
                        })
                    })
                })

            }
        },
    }
</script>

<style scoped>

</style>
