<template>
  <div>
    <task-table :items="taskStore.index" />
  </div>
</template>

<script lang="ts" setup>
import { useTaskStore } from '@/store/task.store';
import TaskTable from '@/component/TaskTable.vue';
import { onMounted } from 'vue';

const taskStore = useTaskStore();

onMounted(async () => {
  await taskStore.getTasks();
});
</script>
