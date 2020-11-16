import { getField } from 'vuex-map-fields';

const isLoading= (state) => {
	return state.loading
}

const isLoggedIn= (state) => {
	return state.isLoggedIn
}

const currentUser= (state) => {
	return state.currentUser
}

const authError= (state) => {
	return state.auth_error
}

export {
	isLoading,
	isLoggedIn,
	currentUser,
	authError,
	getField,
}