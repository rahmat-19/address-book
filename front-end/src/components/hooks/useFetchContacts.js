// src/composables/useFetchUsers.js
import { ref, watch, onMounted, inject } from "vue";
import Api from "../utils/axios";
import { buildQuery } from "../utils/queryBuilder";
import { useRouter } from "vue-router";
import {
  removeData,
  exportData,
  tamplateImport,
} from "../utils/ImplementApiContact";

export function useFetchContacts(
  searchQuery,
  activeFilter,
  selectedCategory,
  currentPage
) {
  const router = useRouter();
  const showNotification = inject("showNotification");

  const contacts = ref([]);
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
    contacts.value = data.data;
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
      const response = await exportData(query);

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", "contact.xlsx");
      document.body.appendChild(link);
      link.click();
      showNotification("Data Contact Sucessfuly Export", "success");
    } catch (error) {
      console.error("Error downloading Excel file:", error);
    }
    return true;
  };
  const getTamplateImport = async () => {
    try {
      const response = await tamplateImport();

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", "tamplate.xlsx");
      document.body.appendChild(link);
      link.click();
      showNotification("Tamplate Import Download Sucessfuly", "success");
    } catch (error) {
      console.error("Error downloading Excel file:", error);
    }
    return true;
  };

  const deleteUserSelected = async (id) => {
    try {
      await removeData(id);
      showNotification("Contact Deleted Sucessfuly", "success");
      fetchDataUsers();
    } catch (error) {
      console.log(error);
    }
  };
  const redirectPageCreateContact = () => {
    router.push({ name: "users.create" });
  };
  const redirectPageUpdateContact = (id) => {
    router.push({
      name: "users.update",
      params: { id },
    });
  };

  onMounted(() => {
    fetchDataUsers();
  });

  watch([searchQuery, activeFilter, selectedCategory, currentPage], () => {
    fetchDataUsers();
  });

  return {
    contacts,
    pagination,
    fetchDataUsers,
    getUsesrExportExcel,
    redirectPageCreateContact,
    redirectPageUpdateContact,
    deleteUserSelected,
    getTamplateImport,
  };
}
