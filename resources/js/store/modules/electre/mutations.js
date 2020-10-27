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

const SET_CD_DD = (state, payload) => {	
	state.cd_dd = payload
}

const SET_DOMINAN_CDDD = (state, payload) => {	
	state.dominan_cd_dd = payload.dominan_CDDD
	state.threshold_cd = payload.thresholdCD
	state.threshold_dd = payload.thresholdDD
}

const SET_AGGREGATE = (state, payload) => {	
	state.aggregate_dominan = payload	
}

const SET_RANK = (state, payload) => {	
	state.rank = payload	
}


export {
	SET_BOBOT,
	SET_MATRIX_X,
	SET_MATRIX_R,
	SET_MATRIX_V,
	SET_CD_DD,
	SET_DOMINAN_CDDD,
	SET_AGGREGATE,
	SET_RANK,
	UPDATE_FIELD
}