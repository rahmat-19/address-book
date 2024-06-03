import Api from "./axios";
import { getHeaderConfigAxios } from "./getHeaderConfigAxios";
import VueCookies from "vue-cookies";

const resource = "/users";
export const allData = (query) =>
  Api.get(`${resource}?${query}`, getHeaderConfigAxios());

export const getData = (id) =>
  Api.get(`${resource}/${id}`, getHeaderConfigAxios());

export const createData = (from) =>
  Api.post(resource, from, getHeaderConfigAxios());

export const updateData = (id, from) =>
  Api.post(`${resource}/${id}`, from, getHeaderConfigAxios());

export const updateActive = (id, from) =>
  Api.post(`${resource}/status/update/${id}`, from, getHeaderConfigAxios());

export const removeData = (id) =>
  Api.delete(`${resource}/${id}`, getHeaderConfigAxios());

export const dashboardData = () =>
  Api.get(`${resource}/dashboard/group-by`, getHeaderConfigAxios());

export const exportData = (query) =>
  Api.get(`${resource}/document/export?${query}`, {
    responseType: "blob",
    headers: {
      Authorization: `Bearer ${VueCookies.get("token")}`,
    },
  });

export const tamplateImport = () =>
  Api.get(`${resource}/document/import-tamplate`, {
    responseType: "blob",
    headers: {
      Authorization: `Bearer ${VueCookies.get("token")}`,
    },
  });

export const importData = (form) =>
  Api.post(`${resource}/document/import-contacts`, form, {
    responseType: "blob",
    headers: {
      Authorization: `Bearer ${VueCookies.get("token")}`,
    },
  });
