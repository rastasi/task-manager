import { createRouter, createWebHistory } from 'vue-router';
import { taskRouter } from '@/router/task.router';
import { pageTitleMiddleware } from '@/router/middleware/page-title.middleware';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    ...taskRouter,
  ],
});

router.beforeEach(pageTitleMiddleware)

export default router;