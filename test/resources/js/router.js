import VueRouter from 'vue-router';
import Login from './components/LoginCom';
import Shipment from './components/ShipmentCom'
import ShipmentNew from './components/ShipmentNew'

const Foo = { template: '<div>foo</div>' }

export default new VueRouter({
   routes:[
       {
           path: '/login',
           component:Login
       },
       {
           path: '',
           component:Shipment
       },
       {
           path: '/shipment/:index',
           component:ShipmentNew,
           name:'shipment'
       }
   ],
   mode:'history'
});