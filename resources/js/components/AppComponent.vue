<template>
	<div>		
		<div id="wrapper" class="wrapper" >
			<navbar></navbar>   
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
        'navbar' : Navbar,       
    }, 
created(){
	this.init();
},
methods:{
	init(){		
		
	}
},
data() {
	return {
		request:{

		}
	}
}
				
}
</script>

