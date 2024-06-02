import Api from "./axios";
const resource = "/users";
export const allData = () => Api.get(resource);

export const getData = (id) => Api.get(`${resource}/${id}`);

export const createData = (task) => Api.post(resource, task);

export const updateData = (id, task) => Api.patch(`${resource}/${id}`, task);

export const removeData = (id) => Api.delete(`${resource}/${id}`);

export const dashboardData = () => Api.get(`${resource}/dashboard/group-by`);

export const exportData = (query) =>
  Api.get(`${resource}/document/export?${query}`, {
    responseType: "blob",
  });

export const tamplateImport = () =>
  Api.get(`${resource}/document/tamplate`, {
    responseType: "blob",
  });
