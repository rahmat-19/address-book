import { onMounted, ref } from "vue";
import { dashboardData } from "../utils/ImplementApiContact";
import Api from "../utils/axios";

export function useFatchDashboard() {
  const groupBy = ref(null);

  const fetchDataUsers = async () => {
    const { data } = (await dashboardData()).data;
    groupBy.value = data;
  };

  onMounted(() => {
    fetchDataUsers();
  });

  return {
    groupBy: groupBy,
  };
}
