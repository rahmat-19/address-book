<script setup>
import { inject, ref } from "vue";
import { useFetchContacts } from "../../components/hooks/useFetchContacts";
import Pagiantion from "../../components/views/users/Pagiantion.vue";
import FillterContact from "../../components/views/users/FillterContact.vue";
import TableViews from "../../components/views/users/TableViews.vue";
import ActionButtonContacts from "../../components/views/users/ActionButtonContacts.vue";
import Modal from "../../components/utils/Modal.vue";

const searchQuery = ref("");
const activeFilter = ref("");
const selectedCategory = ref("");
const currentPage = ref(1);
const file = ref(null);

const {
  contacts,
  pagination,
  isModalOpen,
  getUsesrExportExcel,
  deleteUserSelected,
  redirectPageCreateContact,
  redirectPageUpdateContact,
  getTamplateImport,
  uploadFile,
  openModal,
  handleUpdateActive,
} = useFetchContacts(searchQuery, activeFilter, selectedCategory, currentPage);

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    currentPage.value--;
  }
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    currentPage.value++;
  }
};

const onChangeSearch = (value) => {
  searchQuery.value = value;
};
const onChangeCategory = (value) => {
  selectedCategory.value = value;
};
const onChangeStatus = (value) => {
  activeFilter.value = value;
};

const onFileChange = (event) => {
  file.value = event.target.files[0];
};

const handleUploadFile = () => {
  uploadFile(file);
};
</script>

<template>
  <div class="container-users">
    <!-- FILTER CONTACT -->
    <FillterContact
      @change:serach="onChangeSearch"
      @change:category="onChangeCategory"
      @change:status="onChangeStatus"
    ></FillterContact>

    <div class="body-users">
      <!-- SHOW MODAL -->
      <Modal dal :isOpen="isModalOpen" @close:modal="openModal">
        <p>Import Contact</p>
        <div class="modal-container">
          <span class="text-title">Import File Excel</span>
          <span class="text-body" @click="getTamplateImport"
            >Download Tamplate Excel</span
          >
          <label for="file-upload" class="custom-file-upload">
            <input id="file-upload" type="file" @change="onFileChange" />
            Upload File
          </label>

          <button class="text-button" @click="handleUploadFile">
            Submit File
          </button>
        </div>
      </Modal>

      <!-- BUTTION -->
      <ActionButtonContacts
        @click:export="getUsesrExportExcel"
        @click:redirect:create="redirectPageCreateContact"
        @close:modal="openModal"
      ></ActionButtonContacts>

      <!-- TABLE -->
      <TableViews
        :contacts="contacts"
        @click:redirect:update="redirectPageUpdateContact"
        @click:delete="deleteUserSelected"
        @click:update:active="handleUpdateActive"
      ></TableViews>

      <!-- PAGINATION -->
      <Pagiantion
        @click:prev="prevPage"
        @click:next="nextPage"
        :pagination="pagination"
      ></Pagiantion>
    </div>
  </div>
</template>

<style>
.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  background-color: #f9f9f9;
  border-radius: 4px;
}

.custom-file-upload:hover {
  background-color: #e9e9e9;
}
</style>
