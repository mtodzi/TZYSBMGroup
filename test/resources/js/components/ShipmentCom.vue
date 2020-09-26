<template>
    <div class="card">
        <div class="card-header">
            Посылки
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <router-link class="btn btn-success"  to="/shipment/-1">Новая доставка</router-link>
            </div>
        </div>
        <div class="card-body ">
            <div class="card m-2" v-for="(shipment,index) in allShipment" :key="index">               
                <div class="card-body">
                    {{shipment.id}} {{shipment.name}} 
                    <div class="btn-group float-right" role="group" aria-label="Basic example">                       
                        <button v-on:click="update_shipment(index)" type="button" class="btn btn-primary">Обновить</button>
                        <button v-on:click="delete_shipment(index)" type="button" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </div>   
        </div>
    </div> 
    
</template>

<script>
    console.log("Сработал");
    import {mapGetters, mapActions} from "vuex";
    export default {
        data(){
            return{
                
            }
        },
        computed:{
            ... mapGetters(["getAuth", "allShipment"]),
        },
        methods:{
            ... mapActions(["fetchShipment","deleteShipment"]),
            delete_shipment:function(index){
                this.deleteShipment(index);
            },
            update_shipment:function(index){
                this.$router.push({ name: 'shipment', params: { index: index }});    
            }

        },   
        async mounted(){
            console.log(this.getAuth.token +" тут должен был токен");
            if(!this.getAuth.token){
                this.$router.push("/login");
            }else{
                this.fetchShipment()
            }
  
        }    
    }
</script>