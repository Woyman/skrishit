<template>
	<div>		
		<div id="wrapper" class="wrapper" >    
    		<div class="content-wrapper">  
				<router-view></router-view>
    		</div>
		</div>
	</div>
</template>

<script>
// import {mapGetters} from 'vuex';
// import {createHelpers} from 'vuex-map-fields'

export default {

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

