import { updateField as UPDATE_FIELD } from 'vuex-map-fields';
import { default_state } from './const';
import { copy } from '../../../config/helpers.js';

const SET_BOBOT = (state, payload) => {	
	state.bobot_preferensi = payload		
}

const SET_MATRIX_X = (state, payload) => {	
	state.matrix_x = payload		
}

const SET_MATRIX_R = (state, payload) => {	
	state.matrix_r = payload		
}

const SET_MATRIX_V = (state, payload) => {	
	state.matrix_v = payload		
}


export {
	SET_BOBOT,
	SET_MATRIX_X,
	SET_MATRIX_R,
	SET_MATRIX_V,
	UPDATE_FIELD
}