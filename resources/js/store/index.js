import Vue from 'vue'
import Vuex from 'vuex'

import role from './modules/role/index.js'
import speciality from './modules/speciality/index.js';
import hero from './modules/hero/index.js';
import kriteria from './modules/kriteria/index.js'
import electre from './modules/electre/index.js'
// import auth from './modules/auth/index.js';

Vue.use( Vuex )

export default new Vuex.Store({

    modules: {
        role,
        speciality,
        hero,
        kriteria,
        electre
        // auth
    }

});