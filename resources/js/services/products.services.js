import axios from 'axios';

const endpointUrl = "http://localhost:8000/api/collections/products/list";

class ProductsServices {
  getAllProducts() {
    return axios.get(`${endpointUrl}`);
  }
}

export default new ProductsServices();