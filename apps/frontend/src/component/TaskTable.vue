<template>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">{{ t('task.description') }}</th>
        <th class="text-left">{{ t('task.user') }}</th>
        <th class="text-left">{{ t('task.estimated_time') }}</th>
        <th class="text-left">{{ t('task.used_time') }}</th>
        <th class="text-left">{{ t('task.completed_at') }}</th>
        <th class="text-left">✔</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <td>{{ item.description }}</td>
        <td>{{ item.user.name }}</td>
        <td>{{ item.estimated_time }} {{ t('global.minutes') }}</td>
        <td>{{ item.used_time }} {{ t('global.minutes') }}</td>
        <td>
          <v-btn
            v-if="!item.completed_at"
            size="x-small"
            variant="outlined"
            color="success"
            @click="() => onCompleted(item)"
          >
            {{ t('task.complete') }}
          </v-btn>
          <span v-else>{{ item.completed_at }}</span>
        </td>
        <td>
          <input
            type="checkbox"
            :checked="item.selected"
            @change="event => onSelect(item, event.target.checked)"
          />
        </td>
      </tr>
    </tbody>
  </v-table>
</template>

<script setup lang="ts">
import { Task } from '@/lib/interfaces/task.interface';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

defineProps<{
  items: Task[],
  onSelect: (task: Task, selected: boolean) => void;
  onCompleted: (task: Task) => void;
}>()
</script>