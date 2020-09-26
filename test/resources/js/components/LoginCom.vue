<template>
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Войти</div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" v-model="email" v-bind:class="{ 'is-invalid': error_email}" type="email" class="form-control " name="email" value="" required autocomplete="email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{msg_error_passwor}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" v-model="password" type="password" v-bind:class="{ 'is-invalid': error_password}" class="form-control" name="password" required autocomplete="current-password">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{msg_error_email}}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button v-on:click="login" type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import {mapMutations,mapGetters} from "vuex";
    import axios from 'axios';
    export default {        
        data(){
            return{
                email: "",
                error_email: false,
                msg_error_email:"msg",
                password: "",
                error_password:false,
                msg_error_passwor:"msg",     
            }
        },
        computed:{
            ... mapGetters(["getAuth"]),   
        }, 
        methods:{
            ...mapMutations(['updateAuth']),
            login:function(){
                console.log(this.getAuth.token +" тут должен был токен");
                console.log("login");
                let urlSend = "/api/auth/login";
                let Data = {
                    email:this.email,
                    password:this.password
                }
                var app = this;
                axios.post(urlSend, Data, {
                    headers: {
                        'Accept': "application/json",
                        "Content-Type":"application/json"
                    }
                })
                .then(function (response) {
                    console.log(response);
                    console.log(app);
                    app.updateAuth(response.data);
                    app.$router.go(-1);
                })
                .catch(function (error) {
                    console.log(error);                 
                });
            }
        }
    }
</script>