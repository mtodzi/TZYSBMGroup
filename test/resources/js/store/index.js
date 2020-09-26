import Vue from 'vue';
import Vuex from 'vuex'
import auth from './modules/auth'
import shipment from './modules/shipment'
import item from './modules/item'

Vue.use(Vuex);

export default new Vuex.Store({   
    modules:{
        auth,
        shipment,
        item
    }
});


