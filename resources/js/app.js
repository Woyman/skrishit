// require('./bootstrap');
window.Vue = require('vue');

import router from './router/index.js'
import store from './store/index.js'

import App from './components/AppComponent'

import SimpleVueValidation from 'simple-vue-validator'

window.axios = require('axios')

function getToken(){
    if(localStorage.getItem('user'))
    {
        let user = JSON.parse(localStorage.getItem('user'));
        return user.token        
    }
    return null
}


if(getToken())
{
    axios.defaults.headers.common["Authorization"] = "Bearer" + getToken();    
}

Vue.use(SimpleVueValidation)

router.beforeEach((to, from, next) => {

    const require_auth = to.matched.some(record => record.meta.require_auth)
    const current_user = localStorage.getItem("user")
        
    if(require_auth && !current_user )
    {
        next('/admin/login')
    }else if(to.path == '/admin/login' && current_user ){
        next('/admin')
    }else{
        next()
    }
})

const app = new Vue({
    el: '#app',
    components : { App },
    router,
    store
});
