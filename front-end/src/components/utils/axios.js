import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
const Api = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL_API,
});

export default Api;
