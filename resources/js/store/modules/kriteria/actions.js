import Axios from 'axios'

const getAllKriteria = async (context) => {
    let url = '/api/kriteria'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const getOneKriteria = async (context, payload) => {
    let url = '/api/kriteria/'+payload.idKriteria                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const insertKriteria = async (context, payload) => {
    let url = '/api/kriteria'          
    // console.log(payload)  
    
    let response = await Axios.post(url, payload)

    return response.data.data        
}

const deleteKriteria = async (context, payload) => {
    
    console.log(payload)  
    let url = '/api/kriteria/delete/'+payload.idKriteria          
    // console.log(url)  
    let response = await Axios.get(url)

    return response.data.data        
}

const updateKriteria = async (context, payload) => {
    let url = '/api/kriteria/update'          
    // console.log(payload)  
    let data = {
        '_id': payload._id, 
        'kriteria_name' : payload.kriteria_name,
        'kriteria_field' : payload.kriteria_field
    }
    let response = await Axios.post(url, data)

    return response.data.data        
}

export {
    getAllKriteria,
    getOneKriteria,
    insertKriteria,
    deleteKriteria,
    updateKriteria
    
};