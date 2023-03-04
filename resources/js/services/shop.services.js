import axios from 'axios';

import collectionConstants from '../constants/constants';

const endpointUrl = `${collectionConstants.BASE_URL}`;

class ShopServices {
  getOrdersFields() {
    return axios.get(`${endpointUrl}/collections/Orders`);
  }
  getMyCartProducts() {
    return axios.create({ withCredentials: true }).get(`${endpointUrl}/shop/cart`, );
  }
}

export default new ShopServices();