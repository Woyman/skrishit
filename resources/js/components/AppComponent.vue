<template>
	<div>
        <navbar></navbar>
        <div class="container-fluid">  
            <router-view></router-view>        
        </div>        	
	</div>
</template>

<script>
import Navbar from './admin/layouts/NavbarComponent'

export default {
    components: {
        'navbar' : Navbar
    }
}
</script>