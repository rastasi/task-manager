<template>
  <div>
    <task-form-dialog
        :users="userStore.index"
        :onSubmit="handleFormDialogSubmit"
      />
    <v-row class="mb-4" justify="end">
      <v-col cols="auto">
        <v-btn color="primary" @click="handleCreate">
          {{ t('task.create') }}
        </v-btn>
      </v-col>
    </v-row>
    <task-table
      :items="taskStore.index"
      :onSelect="handleSelect"
      :onComplete="handleComplete"
      :onDelete="handleDelete"
      :onEdit="handleEdit"
    />
    <task-table-summary  v-if="taskStore.numOfSelected > 0" />
  </div>
</template>

<script lang="ts" setup>
import TaskFormDialog from '@/component/TaskFormDialog.vue';
import { useTaskStore } from '@/store/task.store';
import { useUserStore } from '@/store/user.store';
import { useTaskFormDialogStore } from '@/store/taskFormDialog.store';
import TaskTable from '@/component/TaskTable.vue';
import { Task } from '@/lib/interfaces/task.interface';
import { onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import TaskTableSummary from '@/component/TaskTableSummary.vue';

const { t } = useI18n();

const taskStore = useTaskStore();
const userStore = useUserStore();
const taskFormDialogStore = useTaskFormDialogStore();

onMounted(async () => {
  await taskStore.getAll();
  await userStore.getAll();
});


const handleCreate = () => {
  taskStore.setCurrent({
    description: '',
    used_time: 0,
    estimated_time: 0,
    user_id: undefined,
  });
  taskFormDialogStore.open();
};

const handleEdit = (task: Task) => {
  taskStore.setCurrent(task)
  taskFormDialogStore.open();
};

const handleFormDialogSubmit = async () => {
  if (taskStore.current?.id) {
    await taskStore.update(taskStore.current.id, taskStore.current);
  } else {
    await taskStore.create(taskStore.current as Omit<Task, 'id' | 'selected'>);
  }
};

const handleSelect = (task: Task, selected: boolean) => {
  if (selected) {
    taskStore.select(task.id);
  } else {
    taskStore.deselect(task.id);
  }
};

const handleComplete = (task: Task) => {
  taskStore.setCompleted(task.id);
};

const handleDelete = (task: Task) => {
  if (confirm(t('global.confirm'))) {
    taskStore.destroy(task.id);
  }
};

</script>
