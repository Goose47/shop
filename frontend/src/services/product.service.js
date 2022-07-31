import RestService from "@/services/rest.service";
import axios from "axios";


class ProductService extends RestService {
  async store(data) {
    return axios.post(`${this.url}`, data, {headers: {'Content-Type': 'multipart/form-data'}})
  }
  async update(data, id) {
    data.append('_method', 'PUT')
    return axios.post(`${this.url}/${id}`, data)
  }
}

export default new ProductService('products')