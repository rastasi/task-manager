import axios, { AxiosInstance, AxiosRequestConfig } from 'axios';

const apiCall = (): AxiosInstance => {
    const config: AxiosRequestConfig = {
      baseURL: '/api/',
    };
    const instance = axios.create(config);

    return instance;
  }


  export default {
    apiCall
  }