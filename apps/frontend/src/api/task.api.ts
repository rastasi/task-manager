import { Task } from "@/lib/interfaces/task.interface";
import api from "@/api/api";

const index = async (): Promise<Task[]> => {
    const response = await api.apiCall().get("/task");
    return response.data as Task[];
}

const show = async (taskId: string): Promise<Task> => {
    const response = await api.apiCall().get(`/task/${taskId}`);
    return response.data as Task;
}

export default {
    index,
    show
}