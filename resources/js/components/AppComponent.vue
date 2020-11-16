<template>
	<div>		
		<div id="wrapper" class="wrapper" >
			<navbar v-if="isLogin != 'login' ">
			</navbar >   
    		<div class="content-wrapper">  
				<router-view></router-view>
    		</div>
		</div>
	</div>
</template>

<script>
import Navbar from './layout/NavbarComponent'

export default {
components:{                
        'navbar' : Navbar       
	}, 
computed:{
        isLogin() {   
            return this.$route.name            
        },
    },
created(){
	
},
methods:{
	
},
data() {
	return {
		
	}
}
				
}
</script>

