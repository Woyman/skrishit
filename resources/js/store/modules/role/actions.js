import Axios from 'axios'


const getAllRole = async (context) => {
    let url = '/api/role'     
    
    let response = await Axios.get(url)

    return response.data.data       
}

const getOneRole = async (context, payload) => {
    let url = '/api/role/'+payload.idRole                
    
    let response = await Axios.get(url)

    
    return response.data.data       
}

const insertRole = async (context, payload) => {
    let url = '/api/role'          
    // console.log(payload)  
    
    let response = await Axios.post(url, payload)

    return response.data.data        
}

const deleteRole = async (context, payload) => {
    
    console.log(payload)  
    let url = '/api/role/delete/'+payload.idRole          
    console.log(url)  
    let response = await Axios.get(url)

    return response.data.data        
}

const updateRole = async (context, payload) => {
    let url = '/api/role/update'          
    // console.log(payload)  
    let data = {
        '_id': payload._id,
        'role_name' : payload.role_name
    }
    let response = await Axios.post(url, data)

    return response.data.data        
}

export {
    getAllRole,
    getOneRole,
    insertRole,
    deleteRole,
    updateRole
    
};