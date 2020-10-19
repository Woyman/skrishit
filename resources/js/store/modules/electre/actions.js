import Axios from 'axios'

const sendBobot = async (context, payload) => {
    let url = '/api/electre'                    

    console.log(payload)
    let response = await Axios.post(url, payload)
    
    console.log(response)
    // return response.data.data       
}



export {
    sendBobot,
    
};