import axios from 'axios';

import collectionConstants from '../constants/constants';

const endpointUrl = `${collectionConstants.BASE_URL}/${collectionConstants.ORDERS}`;

class OrdersServices {
  getOrdersFields() {
    return axios.get(`${endpointUrl}`);
  }
}

export default new OrdersServices();