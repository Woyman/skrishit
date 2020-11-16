<template>
   
    <div class="col-md-4 mx-auto" style="margin-top: 10em">
        <div class="card">
            <div class="card-header text-center">
                {{ pageTitle }}
            </div>
            <div class="card-body ">
                <form @submit.prevent="authenticate">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" v-model="form.email" placeholder="Email">
                        <!-- <small class="text-danger" v-if="required" >Email is required.</small>                     -->
                    </div>  
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password">
                        <!-- <small class="text-danger" v-if="required" >Email is required.</small>                     -->
                    </div>  
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-primary"> 
                    </div>  
                </form>
            </div>              
        </div>
    </div>   
</template>

<script>
import {login} from '../helpers/auth' 

export default {   
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
    },
    created(){
       
    },
    methods:{
       
        authenticate()
        {            
            this.$store.dispatch('auth/login')

            login(this.$data.form).then((res) => {
                
                this.$store.commit("auth/LOGIN_SUCCESS", res)
                this.$router.push({path: '/'})
            }).catch((error) => {
                this.$store.commit("auth/LOGIN_FAILED", {error}) 

            })
            
        }       
    },
    data(){
        return{
            form:{
                email: '',
                password: ''
            },
            error: null
        }
    }
}
</script>
