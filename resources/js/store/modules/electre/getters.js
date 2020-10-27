import { getField } from 'vuex-map-fields';

const getBobot= (state) => {
	return state.bobot_preferensi
}

const getMatrixX= (state) => {
	return state.matrix_x
}

const getMatrixR= (state) => {
	return state.matrix_r
}

const getMatrixV= (state) => {
	return state.matrix_v
}

const getCD_DD= (state) => {
	return state.cd_dd
}

const getDominan_CDDD= (state) => {
	return state.dominan_cd_dd
}

const getThresholdCD= (state) => {
	return state.threshold_cd
}

const getThresholdDD= (state) => {
	return state.threshold_dd
}

const getAggregateDominan= (state) => {
	return state.aggregate_dominan
}

const getRanking= (state) => {
	return state.rank
}



export {
	getBobot,
	getMatrixX,
	getMatrixR,
	getMatrixV,
	getCD_DD,	
	getDominan_CDDD,
	getThresholdCD,
	getThresholdDD,
	getAggregateDominan,
	getRanking,
	getField,
}