import { defineStore } from 'pinia';

interface TaskFormDialogStore {
  visible: boolean;
}

export const useTaskFormDialogStore = defineStore('taskFormDialog', {
  state: (): TaskFormDialogStore => {
    return {
      visible: false,
    };
  },
  actions: {
    open() {
      this.visible = true;
    },
    close() {
      this.visible = false;
    },
  },
});
