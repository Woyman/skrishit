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



export {
	getBobot,
	getMatrixX,
	getMatrixR,
	getMatrixV,
	getField,
}