import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
// axios.defaults.baseURL = "http://localhost:8000";
const Api = axios.create({
  //set default endpoint API
  baseURL: "http://localhost:8000",
});

export default Api;
