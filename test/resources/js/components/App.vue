<template>
    <div class="body">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand"  to="/">Главная</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!--<li class="nav-item">
                            <router-link class="nav-link" active-class="active" to="/login">login</router-link>
                        </li>-->
                    </ul>
                </div>        
            </div>
        </nav> 
        <div class="container mt-2">   
            <router-view></router-view>
        </div>    
    </div>          
</template>

<script>
    export default {
        
    }
</script>
<style>
</style>