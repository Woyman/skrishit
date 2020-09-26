import Axios from 'axios'

const getAllRole = async (context) => {
    let url = '/api/role'                
    let response = await Axios.get(url)

    // console.log(response)
    return response.data.data       
}

const insertRole = async (context, payload) => {
    let url = '/api/role'                
    let response = await Axios.post(url, {
        params: payload
    })

    return response.data.data        
}

// const getCustomerDetail = async (context, payload) => {
//     let url = '/api/v1/customer/detail'                
//     let response = await Axios.get(url, {
//         params: payload
//     })

//     return response.data.data        
// }

export {
    getAllRole,
    insertRole
    
};