import Axios from 'axios'

const sendBobot = async (context, payload) => {
    let url = '/api/electre'                    

    // console.log(payload)
    let response = await Axios.post(url, payload)
        
    return response.data.data       
}

const submit = async (context, payload) => {
    let url = '/api/hitung-electre'                    

    // console.log(payload)
    let response = await Axios.post(url, payload)
    let result = response.data.data           
    
    context.commit('SET_BOBOT', result.bobot_preferensi)  
    context.commit('SET_MATRIX_X', result.matrix_X)  
    context.commit('SET_MATRIX_R', result.matrix_R)    
    context.commit('SET_MATRIX_V', result.matrix_V)    
    context.commit('SET_CD_DD', result.CD_DD)    
    context.commit('SET_DOMINAN_CDDD', result.dominan_CDDD)    
    context.commit('SET_AGGREGATE', result.aggregate_dominan)    
    context.commit('SET_RANK', result.ranking)    
    return result
}


const getAllHero = async (context) => {
    let url = '/api/user/hero'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const getOneHero = async (context, payload) => {
    let url = '/api/user/hero/'+payload.idHero                
    let response = await Axios.get(url)
    // console.log(response)  
    let hero = response.data.data       
    let role = hero.role
    let speciality = hero.speciality
    hero.role = role.join(', ')
    hero.speciality = speciality.join(', ')

    return hero
}

const getAllKriteria = async (context) => {
    let url = '/api/user/kriteria'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const getAllRole = async (context) => {
    let url = '/api/user/role'     
    
    let response = await Axios.get(url)

    return response.data.data       
}

const getAllSpeciality = async (context) => {
    let url = '/api/user/speciality'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}


export {
    sendBobot,
    submit,
    getAllHero,
    getOneHero,
    getAllKriteria,
    getAllRole,
    getAllSpeciality
    
};