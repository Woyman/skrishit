const getDefaultState = () => {
	return {
		hero:{
			name: '',
			alias: '',			
			photo_name: 'Pilih gambar',
			photo: null,			
			role: [],
			speciality: [],
			durability: 0,
			offense: 0,
			skill_effect: 0,
			difficulty: 0,
			attributes:{
				move_speed: null,
				att_speed: null,
				base_att_crit_rate: null,
				ability_crit_rate: null,
				physical_att: null,
				physical_deff: null,
				hp: null,
				hp_regen: null,
				magic_power: null,
				magic_deff: null, 
				mana: null,
				mana_regen: null
			},
			price:{
				gold: null,				
				diamond: null
			}
		}
	}
}

const default_state = getDefaultState()

export {
	default_state
}