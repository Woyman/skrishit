import { updateField as UPDATE_FIELD } from 'vuex-map-fields';
import { default_state } from './const';
import { copy } from '../../../config/helpers.js';

const SET_MATRIX_R = (state, payload) => {
	
	state.matrix_x = payload
		
}

export {
	SET_MATRIX_R,
	UPDATE_FIELD
}