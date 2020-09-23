import Vue from 'vue';
import VueRouter from 'vue-router';

import MyRouter from './routes';

// import Notfound from '@/components/errors/NotfoundComponent';
// import UnsupportedBrowser from '@/components/errors/UnsupportedBrowserComponent.vue';

Vue.use(VueRouter);

var AllRoutes = []

// const ErrorRoute = [
// 	{
// 		path: '/*',
// 		name: 'notfound',
// 		component: Notfound
// 	},
// ]

AllRoutes = AllRoutes.concat(MyRouter)

const routes = AllRoutes

const router = new VueRouter({
	mode: 'history',
	routes,
});

export default router;