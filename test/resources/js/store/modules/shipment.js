import axios from 'axios';
export default {    
    actions:{
        async fetchShipment(ctx){
            //console.log(ctx.rootGetters.getAuth.token);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/shipment";
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
                ctx.commit('upddateShipment',response.data.shipments);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        },
        addShipment(ctx,name){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/shipment";
            let Data = {name:name};
            axios.post(urlSend, Data, {
                headers: {
                    'Accept': "application/json",
                    'Content-Type':"application/json",
                    'cache-control':"no-cache"
                }
            })
            .then(function (response) {
                console.log(response);
                ctx.commit('addShipment',response.data.shipment);                
            })
            .catch(function (error) {
                console.log(error);                 
            });
        },
        updateShipment(ctx,shipment){
            console.log(shipment);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/shipment/"+shipment.id;
            let Data = {name:shipment.name};
            axios.put(urlSend, Data, {
                headers: {
                    'Accept': "application/json",
                    'Content-Type':"application/json",
                    'cache-control':"no-cache"
                }
            })
            .then(function (response) {
                console.log(response);
                ctx.commit('updateOne',response.data.shipment);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        },
        deleteShipment(ctx,index){
            console.log(ctx.rootGetters.allShipment[index].id);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + ctx.rootGetters.getAuth.token;
            let urlSend = "http://tzysbm/api/shipment/"+ctx.rootGetters.allShipment[index].id;
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
                ctx.commit('deleteShipment',index);
            })
            .catch(function (error) {
                console.log(error);                 
            });
        }
    },
    mutations:{
        upddateShipment(state,shipment){
            state.shipment = shipment;
        },
        addShipment(state,shipment){
            state.shipment.pop(shipment);
        },
        deleteShipment(state,index){
            state.shipment.splice(index, 1);
        },
        updateOne(state,shipment){
            let state_idex = state.shipment.findIndex(item => item.id == shipment.id);
            if(state_idex != -1){
                state.shipment[state_idex] = shipment;
            }
        }
    },
    state:{
        shipment:[]
    },
    getters:{
        allShipment(state){
            return state.shipment;
        },       
    },
}