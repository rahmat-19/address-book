// src/composables/useFetchUsers.js
import { ref, watch, onMounted } from "vue";
import Api from "../utils/axios";
import { buildQuery } from "../utils/queryBuilder";

export function useFetchUsers(
  searchQuery,
  activeFilter,
  selectedCategory,
  currentPage
) {
  const users = ref([]);
  const pagination = ref({
    current_page: 1,
    last_page: 1,
    next_page_url: null,
    prev_page_url: null,
    total: 0,
    per_page: 10,
  });

  const fetchDataUsers = async () => {
    const query = buildQuery({
      search: searchQuery.value,
      active: activeFilter.value,
      category: selectedCategory.value,
      page: currentPage.value,
    });
    const { data } = (await Api.get(`/users?${query}`)).data;
    users.value = data.data;
    pagination.value = {
      current_page: data.current_page,
      last_page: data.last_page,
      next_page_url: data.next_page_url,
      prev_page_url: data.prev_page_url,
      total: data.total,
      per_page: data.per_page,
    };
  };

  const getUsesrExportExcel = async () => {
    const query = buildQuery({
      search: searchQuery.value,
      active: activeFilter.value,
      category: selectedCategory.value,
    });
    try {
      const response = await Api.get(`/users/export?${query}`, {
        responseType: "blob",
      });

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", "users.xlsx");
      document.body.appendChild(link);
      link.click();
    } catch (error) {
      console.error("Error downloading Excel file:", error);
    }
    return true;
  };

  const deleteUserSelected = async (id) => {
    await Api.delete(`/users/${id}`);
    fetchDataUsers();
  };

  onMounted(() => {
    fetchDataUsers();
  });

  watch([searchQuery, activeFilter, selectedCategory, currentPage], () => {
    fetchDataUsers();
  });

  return {
    users,
    pagination,
    fetchDataUsers,
    getUsesrExportExcel,
    deleteUserSelected,
  };
}
