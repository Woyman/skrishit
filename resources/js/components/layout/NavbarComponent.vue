<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item" v-bind:class="this.pathName == 'dashboard' ? 'active': '' ">
                <a class="nav-link" href="/">Dahsboard<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" v-bind:class="this.pathName == 'role' ? 'active': '' ">
                <a class="nav-link" href="/role" >Role</a>
            </li>
            <li class="nav-item" v-bind:class="this.pathName == 'speciality' ? 'active': '' ">
                <a class="nav-link" href="/speciality">Speciality</a>
            </li>
            <li class="nav-item" v-bind:class="this.pathName == 'hero' ? 'active': '' ">
                <a class="nav-link" href="/hero" >Hero</a>
            </li>
            <li class="nav-item" v-bind:class="this.pathName == 'kriteria' ? 'active': '' ">
                <a class="nav-link" href="/kriteria" >Kriteria</a>
            </li>
            <li class="nav-item" v-bind:class="this.pathName == 'electre' ? 'active': '' ">
                <a class="nav-link" href="/electre" >Perhitungan Electre</a>
            </li>

            </ul>
        </div>
    </nav>
</template>

<script>
import {mapGetters} from 'vuex';
import {createHelpers} from 'vuex-map-fields'

export default {

created(){
	this.init();
},
methods:{
	init(){		          
            this.pathName = this.$route.meta.menuParent
	}
},
data() {
	return {
        pathName: ''
	}
}
				
}
</script>

