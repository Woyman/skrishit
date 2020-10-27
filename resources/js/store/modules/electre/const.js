const getDefaultState = () => {
	return {	
		bobot_preferensi: null,	
		matrix_x: null,
		matrix_r: null,
		matrix_v: null,
		cd_dd: null,
		dominan_cd_dd: null,
		threshold_cd:null,
		threshold_cd:null,
		aggregate_dominan: null,
		rank: null
	}
}

const default_state = getDefaultState()

export {
	default_state
}