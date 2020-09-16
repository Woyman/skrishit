import Vue from 'vue';
import VueRouter from 'vue-router';
import AdminRouter from './adminrouter';

Vue.use(VueRouter);

var AllRoutes = []

// const ErrorRoute = [
// 	{
// 		path: '/*',
// 		name: 'notfound',
// 		component: Notfound
// 	},
// ]

AllRoutes = AllRoutes.concat(AdminRouter)

const routes = AllRoutes

const router = new VueRouter({
	mode: 'history',
	routes,
});

export default router;