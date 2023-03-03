import axios from 'axios';

import collectionConstants from '../constants/constants';

const endpointUrl = `${collectionConstants.BASE_URL}/products/list`;

class ProductsServices {
  getAllProducts() {
    return axios.get(`${endpointUrl}`);
  }
}

export default new ProductsServices();