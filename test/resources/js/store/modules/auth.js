export default {    
    actions:{},
    mutations:{
        updateAuth(state,newAuth){
            state.auth.token = newAuth.access_token
            state.auth.token_type = newAuth.token_type
            state.auth.expires_in = newAuth.expires_in
            state.auth.time_c = newAuth.time_c
        }
    },
    state:{
        auth:{
            token: "",
            token_type:"",
            expires_in:0,
            time_c:0
        } 
    },
    getters:{
        getAuth(state){
            return state.auth
        }
    },
}


