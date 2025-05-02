import { defineStore } from 'pinia';
import { Task } from '@/lib/interfaces/task.interface';
import taskApi from '@/api/task.api';

interface TaskStore {
  current: Task | null;
  index: Task[];
}

export const useTaskStore = defineStore('task', {
  state: (): TaskStore => {
    return {
      current: null,
      index: [],
    };
  },
  actions: {
    async destroyTask(taskId: number) {
      await taskApi.destroy(taskId);
    },

    async getTasks() {
      this.index = await taskApi.index()
    },
  },
});
