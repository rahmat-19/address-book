import VueCookies from "vue-cookies";

export const getHeaderConfigAxios = () => {
  return {
    headers: {
      Authorization: `Bearer ${VueCookies.get("token")}`,
      "Content-Type": "multipart/form-data",
    },
  };
};
