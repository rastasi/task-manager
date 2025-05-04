import { defineStore } from 'pinia';
import { Task } from '@/lib/interfaces/task.interface';
import taskApi from '@/api/task.api';
import taskDoneApi from '@/api/taskDone.api';


interface TaskStore {
  current: Partial<Task>;
  index: Task[];
}

export const useTaskStore = defineStore('task', {
  state: (): TaskStore => {
    return {
      current: {},
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
    setCurrent(task: Partial<Task>) {
      this.current = task;
    },
    async getAll() {
      const tasks = await taskApi.index();
      this.index = tasks.map(task => ({
        ...task,
        selected: false,
      }));
    },

    select(taskId: number) {
      const task = this.index.find(t => t.id === taskId);
      if (task) {
        task.selected = true;
      }
    },

    deselect(taskId: number) {
      const task = this.index.find(t => t.id === taskId);
      if (task) {
        task.selected = false;
      }
    },

    isSelected(taskId: number): boolean {
      return this.index.find(t => t.id === taskId)?.selected ?? false;
    },

    async destroySelected() {
      const selectedTasks = this.index.filter(t => t.selected);
      await Promise.all(selectedTasks.map(task => this.destroy(task.id)));
    },

    async setCompletedSelected() {
      const selectedTasks = this.index.filter(t => t.selected);
      await Promise.all(selectedTasks.map(task => this.setCompleted(task.id)));
    },

    async setCompleted(taskId: number): Promise<void> {
      await taskDoneApi.create(taskId);
      await this.getAll();
    },

    async create(task: Partial<Task>) {
      await taskApi.create(task);
      await this.getAll();
    },

    async update(taskId: number, task: Partial<Task>) {
      await taskApi.update(taskId, task);
      await this.getAll();
    },

    async destroy(taskId: number) {
      await taskApi.destroy(taskId);
      await this.getAll();
    },
  },
});
