import RestService from "@/services/rest.service";
import axios from 'axios';

class UserService extends RestService {
  async index(params) {
    return axios.get(this.url, {
      params
    })
  }
  ban(id, ban) {
    return axios.post(`${this.url}/${id}/delete`, {
      delete: ban
    })
  }
}

export default new UserService('users')