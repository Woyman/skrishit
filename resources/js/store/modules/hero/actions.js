import Axios from 'axios'

const getAllHero = async (context) => {
    let url = '/api/hero'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const getOneHero = async (context, payload) => {
    let url = '/api/hero/'+payload.idHero                
    let response = await Axios.get(url)
    // console.log(response)  
    let hero = response.data.data       
    let role = hero.role
    let speciality = hero.speciality
    hero.role = role.join(', ')
    hero.speciality = speciality.join(', ')

    return hero
}

const setHero = async (context, payload) => {
    let url = '/api/hero/'+payload.idHero                
    let response = await Axios.get(url)
    // console.log(response)  
    // return response.data.data  
    context.commit('SET_HERO', response.data.data)     
}

const insertHero = async (context, payload) => {
    let url = '/api/hero'          
    // console.log(payload)  
    
    let response = await Axios.post(url, payload)

    return response.data.data        
}

const deleteHero = async (context, payload) => {
         
    let url = '/api/hero/delete/'+payload.idHero          
    // console.log(url)  
    let response = await Axios.get(url)

    return response.data.data        
}

const updateHero = async (context, payload) => {
    let url = '/api/hero/update'          
    // console.log(payload)  
    let response = await Axios.post(url, payload)

    return response.data.data        
}

export {
    getAllHero,
    getOneHero,
    setHero,
    insertHero,
    deleteHero,
    updateHero
    
};