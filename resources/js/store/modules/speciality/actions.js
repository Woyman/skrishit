import Axios from 'axios'

const getAllSpeciality = async (context) => {
    let url = '/api/speciality'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const getOneSpeciality = async (context, payload) => {
    let url = '/api/speciality/'+payload.idSpeciality                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const insertSpeciality = async (context, payload) => {
    let url = '/api/speciality'          
    // console.log(payload)  
    
    let response = await Axios.post(url, payload)

    return response.data.data        
}

const deleteSpeciality = async (context, payload) => {
    
    // console.log(payload)  
    let url = '/api/speciality/delete/'+payload.idSpeciality          
    // console.log(url)  
    let response = await Axios.get(url)

    return response.data.data        
}

const updateSpeciality = async (context, payload) => {
    let url = '/api/speciality/update'          
    // console.log(payload)  
    let data = {
        '_id': payload._id,
        'speciality_name' : payload.speciality_name
    }
    let response = await Axios.post(url, data)

    return response.data.data        
}

export {
    getAllSpeciality,
    getOneSpeciality,
    insertSpeciality,
    deleteSpeciality,
    updateSpeciality
    
};