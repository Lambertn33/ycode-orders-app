import axios from 'axios';

import collectionConstants from '../constants/constants';

const endpointUrl = `${collectionConstants.BASE_URL}`;

class ShopServices {
  getOrdersFields() {
    return axios.get(`${endpointUrl}/collections/Orders`);
  }
  getMyCartProducts(userId) {
    return axios.get(`${endpointUrl}/shop/cart/${userId}`);
  }
  addProductToCart(userId, productId) {
    const newProductInCart = {
      productId
    }
    return axios.post(`${endpointUrl}/shop/cart/${userId}`, newProductInCart);
  }

  removeProductFromCart(userId, productId) {
    return axios.delete(`${endpointUrl}/shop/cart/${userId}/${productId}`);
  }
}

export default new ShopServices();