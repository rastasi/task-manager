import { Task } from "@/lib/interfaces/task.interface";
import api from "@/api/api";

const index = async (): Promise<Task[]> => {
    const response = await api.apiCall().get("/tasks");
    return response.data as Task[];
}

const create = async (task: Partial<Task>): Promise<Task> => {
    const response = await api.apiCall().post('/tasks', task);
    return response.data as Task;
}

const update = async (taskId: number): Promise<Task> => {
    const response = await api.apiCall().put(`/tasks/${taskId}`);
    return response.data as Task;
}

const destroy = async (taskId: number): Promise<void> => {
    await api.apiCall().delete(`/tasks/${taskId}`);
}

export default {
    index,
    create,
    update,
    destroy,
}