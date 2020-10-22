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

    context.commit('SET_MATRIX_R', result.matrix_R)    
    return result
}



export {
    sendBobot,
    submit
    
};