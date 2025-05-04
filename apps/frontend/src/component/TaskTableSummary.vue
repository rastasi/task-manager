<template>
  <div class="mt-6">
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
        <tr>
          <td>{{ t('task.bulkAction') }}</td>
          <td>
            <v-btn
              size="small"
              color="success"
              class="me-2"
              @click="handleSelectedComplete"
            >
              {{ t('task.complete') }}
            </v-btn>
            <v-btn
              size="small"
              color="error"
              @click="handleSelectedDelete"
            >
              {{ t('global.delete') }}
            </v-btn>
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script lang="ts" setup>
import { useTaskStore } from '@/store/task.store';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const taskStore = useTaskStore();

const handleSelectedComplete = () => {
  if (confirm(t('global.confirm'))) {
    taskStore.setCompletedSelected();
  }
};

const handleSelectedDelete = () => {
  if (confirm(t('global.confirm'))) {
    taskStore.destroySelected();
  }
};
</script>
