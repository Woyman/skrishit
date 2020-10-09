import { getField } from 'vuex-map-fields';

const getHero= (state) => {
	return state.hero
}

export {
	getHero,
	getField,
}