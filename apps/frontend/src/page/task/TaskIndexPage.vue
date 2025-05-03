<template>
  <div>
    <task-form-dialog v-model="showFormDialog" :task="formTask" :users="userStore.index" @save="handleFormSubmit" />
    <v-row class="mb-4" justify="end">
      <v-col cols="auto">
        <v-btn color="primary" @click="handleCreate">
          {{ t('task.create') }}
        </v-btn>
      </v-col>
    </v-row>
    <task-table :items="taskStore.index" :onSelect="handleSelect" :onComplete="handleComplete" :onDelete="handleDelete"
      :onEdit="handleEdit" />
    <div v-if="taskStore.numOfSelected > 0" class="mt-6">
      <h3 class="text-h6 mb-2">{{ t('global.summary') }}</h3>

      <v-table density="compact" class="mb-4">
        <tbody>
          <tr>
            <td>{{ t('task.selectedTotalUsedTime') }}</td>
            <td>{{ taskStore.selectedTotalUsedTime }} {{ t('global.minutes') }}</td>
          </tr>
          <tr>
            <td>{{ t('task.selectedTotalEstimatedTime') }}</td>
            <td>{{ taskStore.selectedTotalEstimatedTime }} {{ t('global.minutes') }}</td>
          </tr>
        </tbody>
      </v-table>
    </div>
  </div>
</template>

<script lang="ts" setup>
import TaskFormDialog from '@/component/TaskFormDialog.vue';
import { useTaskStore } from '@/store/task.store';
import { useUserStore } from '@/store/user.store';
import TaskTable from '@/component/TaskTable.vue';
import { Task } from '@/lib/interfaces/task.interface';
import { onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { ref } from 'vue';
import { User } from '@/lib/interfaces/user.interface';

const { t } = useI18n();

const taskStore = useTaskStore();
const userStore = useUserStore();

onMounted(async () => {
  await taskStore.getTasks();
  await userStore.getUsers();
});

const showFormDialog = ref(false);
const formTask = ref<Task | null>(null);

const handleCreate = () => {
  formTask.value = {
    description: '',
    used_time: 0,
    estimated_time: 0,
    user_id: undefined,
  };
  showFormDialog.value = true;
};

const handleEdit = (task: Task) => {
  formTask.value = task;
  showFormDialog.value = true;
};

const handleFormSubmit = async (taskData: Partial<Task>) => {
  if (taskData.id) {
    await taskStore.updateTask(taskData.id, taskData as Task);
  } else {
    await taskStore.createTask(taskData as Omit<Task, 'id' | 'selected'>);
  }
};

const handleSelect = (task: TaskTable, selected: boolean) => {
  if (selected) {
    taskStore.selectTask(task.id);
  } else {
    taskStore.deselectTask(task.id);
  }
};

const handleComplete = (task: TaskTable) => {
  taskStore.setTaskCompleted(task.id);
};

const handleDelete = (task: TaskTable) => {
  if (confirm(t('global.confirm'))) {
    taskStore.destroyTask(task.id);
  }
};
</script>
