import { RouteRecordRaw } from 'vue-router';
import TaskIndexPage from '@/page/task/TaskIndexPage.vue';

export const taskRouter: RouteRecordRaw[] = [
  {
    path: '/',
    name: 'taskIndex',
    component: TaskIndexPage,
  }
];
