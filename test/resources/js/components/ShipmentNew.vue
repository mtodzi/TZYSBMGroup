<template>
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Новая доставка </div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Название доставки</label>
                            <div class="col-md-6">
                                <input id="email" v-model="name" v-bind:class="{ 'is-invalid': error_name}" type="text" class="form-control " name="name"  required>
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{msg_error_name}}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button v-on:click="new_shipment" type="submit" class="btn btn-primary">
                                    {{botton_text}}
                                </button>
                            </div>
                        </div>
                        <div v-if="id>0">
                        <hr><hr>
                        <ul  v-if="allItem.length>0" class="list-group mt-2">
                            <li class="list-group-item">
                                Продукты
                                <div class="btn-group float-right" role="group" aria-label="Basic example">
                                    <button v-on:click="new_item" class="btn btn-success" >Новый продукт</button>
                                </div> 
                            </li>
                            <li v-for="(item,index) in allItem" :key="index" class="list-group-item">
                                <span class="badge badge-primary">{{item.name}}</span>
                                <span class="badge badge-success">{{item.code}}</span>                                
                                <div class="btn-group float-right" role="group" aria-label="Basic example">                       
                                    <button v-on:click="update_item(index)" type="button" class="btn btn-primary">Обновить</button>
                                    <button v-on:click="delete_item(index)" type="button" class="btn btn-danger">Удалить</button>
                                </div>
                            </li>  
                        </ul>
                        <div class="form-group row mt-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Название продукта</label>
                            <div class="col-md-6">
                                <input id="email" v-model="name_prod" v-bind:class="{ 'is-invalid': error_name_prod}" type="text" class="form-control " name="name_prod" >
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{msg_error_name_prod}}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Код продукта</label>
                            <div class="col-md-6">
                                <input id="email" v-model="code_prod" v-bind:class="{ 'is-invalid': error_code_prod}" type="text" class="form-control " name="code_prod">
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{msg_error_code_prod}}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button v-on:click="new_update_item" type="submit" class="btn btn-primary">
                                    {{botton_item_text}}
                                </button>
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
    import {mapGetters, mapActions} from "vuex";
    export default {
        data(){
            return{
                index:-1,
                id:0,
                name: "",
                error_name: false,
                msg_error_name:"msg",
                botton_text:"",

                index_prod:-1,
                id_prod:0,
                shipment_id:0,
                name_prod:"",
                error_name_prod:false,
                msg_error_name_prod:"msg", 
                code_prod:"",
                error_code_prod:false,
                msg_error_code_prod:"msg", 
                botton_item_text:""   
            }
        },
        methods:{
            ... mapActions(["fetchShipment","addShipment","updateShipment","fetchItems","addItem","upddateItem","deleteItem"]),
            new_shipment:function(){
                console.log("new_shipment");                
                ResetErrors(this);
                if(CheckName(this)){
                    if(this.index == -1){
                        this.addShipment(this.name);                        
                        this.$router.push("/");                
                    }else{
                        this.updateShipment({index:this.index, name:this.name, id:this.id});
                    }
                }    
            },
            new_item:function(){
                console.log("new_item");
                ResetErrorsProd(this);
                this.index_prod = -1;
                this.id_prod = 0;
                this.name_prod = "";
                this.code_prod = "";
                this.shipment_id = this.id;
                this.botton_item_text = "Добавить продукт";    
            },
            update_item:function(index){
                console.log("update_item");
                ResetErrorsProd(this);
                this.index_prod = index;
                this.id_prod = this.allItem[index].id;
                this.name_prod = this.allItem[index].name;
                this.code_prod = this.allItem[index].code;
                this.shipment_id = this.id;
                this.botton_item_text = "Обновить продукт";

            },
            new_update_item:function(){
                console.log("new_update_item");
                ResetErrorsProd(this);
                if(this.index_prod == -1){
                    if(CheckProd(this)){
                        this.addItem({name: this.name_prod, code: this.code_prod, shipment_id: this.shipment_id});
                        this.index_prod = -1;
                        this.id_prod = 0;
                        this.name_prod = "";
                        this.code_prod = "";
                        this.shipment_id = this.id;
                        this.botton_item_text = "Добавить продукт";
                    }    
                }else{
                    if(CheckProd(this)){
                        this.upddateItem({id: this.id_prod, name: this.name_prod, code: this.code_prod, shipment_id: this.shipment_id});
                    }
                }    
            },
            delete_item:function(index){
                console.log("delete_item");
                let id = this.allItem[index].id;
                this.deleteItem(id);   
            }
        },
        computed:{
            ... mapGetters(["getAuth","allShipment","allItem"]),
        },
        async mounted(){
            console.log(this.getAuth.token +" тут должен был токен");
            if(!this.getAuth.token){
                this.$router.push("/login");
            }else{
                console.log(this.$route.params.index);
                if(this.$route.params.index == -1){
                    this.botton_text = "Добавить"
                    this.fetchItems(-1);
                    this.shipment_id = 0;
                }else{
                    this.botton_text = "Обнавить"
                    this.name = this.allShipment[this.$route.params.index].name;
                    this.id = this.allShipment[this.$route.params.index].id;
                    this.index = this.allShipment[this.$route.params.index].index;
                    this.fetchItems(this.allShipment[this.$route.params.index].id);
                    this.shipment_id = this.allShipment[this.$route.params.index].id;    
                }
                this.botton_item_text = "Добавить продукт"
                         
            }
  
        }
    }
    function CheckName(page){
        if(page.name.length >= 1){
            return true;
        }else{
            page.error_name = true;
            page.msg_error_name = "Заполните название доставки";
            return false;      
        }
    }
    function CheckProd(page){
        if(page.shipment_id == 0){
            page.error_code_prod = true;
            page.msg_error_code_prod = "Добавьте в начале доставку";
            return false;    
        }
        if(page.name_prod.length == 0){
            page.error_name_prod = true;
            page.msg_error_name_prod = "Заполните название продукта";
            return false;    
        }
        if(page.code_prod.length == 0){
            page.error_code_prod = true;
            page.msg_error_code_prod = "Заполните код";
            return false;
        }
        return true;
    }
    function ResetErrors(page){
        page.error_name = false;
        page.msg_error_name = "msg";    
    }
    function ResetErrorsProd(page){
        page.error_name_prod = false;
        page.msg_error_name_prod = "msg"; 
        page.error_code_prod = false;
        page.msg_error_code_prod = "msg";          
    }
</script>