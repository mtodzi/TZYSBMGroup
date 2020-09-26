import axios from 'axios';
export default {
    actions:{
        async fetchItems(ctx,shipment_id){
            //console.log(ctx.rootGetters.getAuth.token);
            if(shipment_id != -1){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
                let urlSend = "http://tzysbm/api/item/shipment/"+shipment_id;
                let Data = {};
                axios.get(urlSend, Data, {
                    headers: {
                        'Accept': "application/json",
                        'Content-Type':"application/json",
                        'cache-control':"no-cache"
                    }
                })
                .then(function (response) {
                    console.log(response);
                    ctx.commit('upddateItems',response.data.item);
                })
                .catch(function (error) {
                    console.log(error);                 
                });
            }else{
                ctx.commit('upddateItems',[]);
            }    
        },
        addItem(ctx,item){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/item";
            let Data = {
                name: item.name,
                code: item.code,
                shipment_id: item.shipment_id
            };
            axios.post(urlSend, Data, {
                headers: {
                    'Accept': "application/json",
                    'Content-Type':"application/json",
                    'cache-control':"no-cache"
                }
            })
            .then(function (response) {
                console.log(response);
                ctx.commit('addItem',response.data.item);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        },
        upddateItem(ctx,item){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/item/"+item.id;
            let Data = {
                name: item.name,
                code: item.code,
                shipment_id: item.shipment_id
            };
            axios.put(urlSend, Data, {
                headers: {
                    'Accept': "application/json",
                    'Content-Type':"application/json",
                    'cache-control':"no-cache"
                }
            })
            .then(function (response) {
                console.log(response);
                ctx.commit('upddateItem',response.data.item);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        },
        deleteItem(ctx,item){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/item/"+item;
            let Data = {};
            axios.delete(urlSend, Data, {
                headers: {
                    'Accept': "application/json",
                    'Content-Type':"application/json",
                    'cache-control':"no-cache"
                }
            })
            .then(function (response) {
                console.log(response);
                ctx.commit('deleteItem',item);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        }
    },
    mutations:{
        upddateItems(state,items){
            state.items = items;
        },
        addItem(state,item){
            state.items.unshift(item);
        },
        upddateItem(state,item){
            let state_idex = state.items.findIndex(stateItem => stateItem.id == item.id);
            state.items[state_idex].name = item.name;
            state.items[state_idex].code = item.code;
            state.items[state_idex].created_at = item.created_at;
            state.items[state_idex].updated_at = item.updated_at;
        },
        deleteItem(state,id){
            let state_idex = state.items.findIndex(stateItem => stateItem.id == id);
            if(state_idex != -1){
                state.items.splice(state_idex, 1);
            }    
        }
    },
    state:{
        items:[]
    },
    getters:{
        allItem(state){
            return state.items;
        },
    }
}
