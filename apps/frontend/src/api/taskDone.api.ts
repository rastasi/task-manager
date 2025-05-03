import api from "@/api/api";

const create = async (taskId: number): Promise<void> => {
    await api.apiCall().post(`/tasks/${taskId}/done`);
}

export default {
    create,
}