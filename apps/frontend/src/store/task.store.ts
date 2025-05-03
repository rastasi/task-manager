import { defineStore } from 'pinia';
import { Task } from '@/lib/interfaces/task.interface';
import taskApi from '@/api/task.api';
import taskDoneApi from '@/api/taskDone.api';


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
  getters: {
    selectedTotalUsedTime(state): number {
      return state.index
        .filter(task => task.selected)
        .reduce((sum, task) => sum + (task.used_time ?? 0), 0);
    },

    selectedTotalEstimatedTime(state): number {
      return state.index
        .filter(task => task.selected)
        .reduce((sum, task) => sum + (task.estimated_time ?? 0), 0);
    },
    numOfSelected(state): number {
      return state.index.filter(task => task.selected).length;
    },
  },
  actions: {
    async destroyTask(taskId: number) {
      await taskApi.destroy(taskId);
    },

    async getTasks() {
      const tasks = await taskApi.index();
      this.index = tasks.map(task => ({
        ...task,
        selected: false,
      }));
    },

    selectTask(taskId: number) {
      const task = this.index.find(t => t.id === taskId);
      if (task) {
        task.selected = true;
      }
    },

    deselectTask(taskId: number) {
      const task = this.index.find(t => t.id === taskId);
      if (task) {
        task.selected = false;
      }
    },

    isSelected(taskId: number): boolean {
      return this.index.find(t => t.id === taskId)?.selected ?? false;
    },

    async setTaskCompleted(taskId: number): Promise<void> {
      await taskDoneApi.create(taskId);
      await this.getTasks();
    }
  },
});
