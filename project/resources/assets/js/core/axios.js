import Axios from 'axios';
import { stringify, parse } from 'qs';

export default Axios.create({
  baseURL: '/api/',
  paramsSerializer: query => stringify(query, { arrayFormat: 'brackets', encode: false, addQueryPrefix: true }),
});
