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



export {
    sendBobot,
    submit
    
};