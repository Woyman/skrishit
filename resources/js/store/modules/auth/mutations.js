import { updateField as UPDATE_FIELD } from 'vuex-map-fields';
import { default_state } from './const';
import { copy } from '../../../config/helpers.js';

const LOGIN = (state) => {	
	state.loading = true;
	state.auth_error = true;
}

const LOGIN_SUCCESS = (state, payload) => {	
	
	state.auth_error = true;
	state.isLoggedIn = true;
	state.loading = false;
	state.currentUser = Object.assign({}, payload.user, {token: payload.access_token})
	
	localStorage.setItem("user", JSON.stringify(state.currentUser))
}

const LOGIN_FAILED = (state, payload) => {	
	state.loading = false;
	state.auth_error = payload.error;
}
 
const LOGOUT = (state) => {	
	localStorage.removeItem("user")
	state.isLoggedIn = false
	state.currentUser = null
}

export {	
	LOGIN,
	LOGIN_SUCCESS,
	LOGIN_FAILED,
	LOGOUT,
	UPDATE_FIELD
}