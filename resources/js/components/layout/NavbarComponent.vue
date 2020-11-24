<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/admin">
             <img src="/assets/logo.png" width="30" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <template v-if="isAdmin">
                    <li class="nav-item" v-bind:class="this.pathName == 'dashboard' ? 'active': '' ">
                        <a class="nav-link" :href="'/admin'">Dahsboard<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item" v-bind:class="this.pathName == 'role' ? 'active': '' ">
                        <a class="nav-link" href="/admin/role" >Role</a>
                    </li>
                    <li class="nav-item" v-bind:class="this.pathName == 'speciality' ? 'active': '' ">
                        <a class="nav-link" href="/admin/speciality">Speciality</a>
                    </li>
                    <li class="nav-item" v-bind:class="this.pathName == 'hero' ? 'active': '' ">
                        <a class="nav-link" href="/admin/hero" >Hero</a>
                    </li>
                    <li class="nav-item" v-bind:class="this.pathName == 'kriteria' ? 'active': '' ">
                        <a class="nav-link" href="/admin/kriteria" >Kriteria</a>
                    </li>
                    <li class="nav-item" v-bind:class="this.pathName == 'electre' ? 'active': '' ">
                        <router-link class="nav-link" :to="{name:'admin.electre'}" >Perhitungan Electre</router-link>
                    </li>
                </template>
            </ul>
            <ul class="navbar-nav mr-3" v-if="isAdmin">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ adminName }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="!#" @click.prevent="logout" >Logout</a>                        
                    </div>
                </li>
            </ul>


        </div>
    </nav>
</template>

<script>
import {mapGetters} from 'vuex';
import {createHelpers} from 'vuex-map-fields'

export default {
computed:{
        isAdmin() {   
            if(localStorage.getItem('user'))
            {
                return true
            }else{
                return false
            }            
        },
        adminName()
        {
            let user = JSON.parse(localStorage.getItem('user'))
            return user.name;
        }
},
created(){
	this.init();
},
methods:{
	init(){		          
            this.pathName = this.$route.meta.menuParent            
    },
    logout()
    {
        this.$store.commit('auth/LOGOUT')
        this.$router.push({path:"/admin/login"})
    }
},
data() {
	return {
        pathName: ''
	}
}
				
}
</script>

