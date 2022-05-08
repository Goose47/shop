import axios from 'axios';

const ENDPOINT_URL = 'http://localhost:80/api/';

class AuthService {
    login(data) {
        return axios.post(ENDPOINT_URL + 'login', data).catch(e => {
            console.log(e)
        })
    }

    logout() {
        return axios.post(ENDPOINT_URL + 'logout').catch(e => {
            console.log(e)
        })
    }

    register(data) {
        return axios.post(ENDPOINT_URL + 'register', data)
    }

    user() {
        return axios.get(ENDPOINT_URL +'user').catch(e => {
            console.log(e)
        })
    }
}

export default new AuthService();