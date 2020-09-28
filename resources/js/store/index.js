import Vue from 'vue'
import Vuex from 'vuex'

import role from './modules/role/index.js'
import speciality from './modules/speciality/index.js';
// import auth from './modules/auth/index.js';

Vue.use( Vuex )

export default new Vuex.Store({

    modules: {
        role,
        speciality
        // customer,
        // recapOrder,
        // auth
    }

});