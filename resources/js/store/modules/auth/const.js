import { getLocalUser } from "../../../helpers/auth"
// import { getLocalUser } from '../../../helpers/auth';

const user = getLocalUser()


const getDefaultState = () => {
	return {	
		currentUser: user,
		isLoggedIn: !!user,
		loading: null,
		auth_error: null,

	} 
}
const default_state = getDefaultState()

export {
	default_state
}