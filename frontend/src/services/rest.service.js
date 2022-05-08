import axios from 'axios'



export default class RestService {
  constructor(endpoint) {
    this.url = process.env.VUE_APP_API_URL + `/${endpoint}`
  }

  async index() {
    return axios.get(this.url)
  }
  async find(id) {
    return axios.get(`${this.url}/${id}`)
  }
  async store(data) {
    return axios.post(`${this.url}`, data)
  }
  async update(data, id) {
    return axios.put(`${this.url}/${id}`, data)
  }
  async delete(id) {
    return axios.delete(`${this.url}/${id}`)
  }
}

