import { updateField as UPDATE_FIELD } from 'vuex-map-fields';
import { default_state } from './const';
import { copy } from '../../../config/helpers.js';

const RESET_HERO = (state, payload) => {	
	state.hero = Object.assign({}, default_state.hero)
}

const SET_HERO = (state, payload) => {
	
	state.hero = payload
	// console.log(state.hero)
}

export {
	RESET_HERO,
	SET_HERO,
	UPDATE_FIELD
}