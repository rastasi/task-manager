<template>
  <div>
    <task-table :items="taskStore.index" :onSelect="handleSelect" :onCompleted="handleCompleted"/>
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
import { useTaskStore } from '@/store/task.store';
import TaskTable from '@/component/TaskTable.vue';
import { Task } from '@/lib/interfaces/task.interface';
import { onMounted } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const taskStore = useTaskStore();

onMounted(async () => {
  await taskStore.getTasks();
});

const handleSelect = (task: TaskTable, selected: boolean) => {
  if (selected) {
    taskStore.selectTask(task.id);
  } else {
    taskStore.deselectTask(task.id);
  }
};

const handleCompleted = (task: TaskTable) => {
  taskStore.setTaskCompleted(task.id);
};
</script>
