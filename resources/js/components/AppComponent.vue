<template>
	<div>
        <navbar></navbar>
        <h1>Ini adalah komponen vue js </h1>
		<!-- <component :is="layout">
			<router-view></router-view>
		</component> -->
	</div>
</template>

<script>
import Navbar from './layouts/NavbarComponent'

export default {
    components: {
        'navbar' : Navbar
    }
}
</script>