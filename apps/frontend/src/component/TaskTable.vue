<template>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">✔</th>
        <th class="text-left">{{ t('task.description') }}</th>
        <th class="text-left">{{ t('task.user') }}</th>
        <th class="text-left">{{ t('task.estimated_time') }}</th>
        <th class="text-left">{{ t('task.used_time') }}</th>
        <th class="text-left">{{ t('task.completed_at') }}</th>
        <th class="text-left">{{ t('global.edit') }}</th>
        <th class="text-left">{{ t('global.delete') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <td>
          <input type="checkbox" :checked="item.selected" @change="event => onSelect(item, event.target.checked)" />
        </td>
        <td>{{ item.description }}</td>
        <td>{{ item.user.name }}</td>
        <td>{{ item.estimated_time }} {{ t('global.minutes') }}</td>
        <td>{{ item.used_time }} {{ t('global.minutes') }}</td>
        <td>
          <v-btn
            v-if="!item.completed_at"
            @click="onComplete(item)"
            size="x-small"
            color="success"
            variant="outlined"
          >
            {{ t('task.complete') }}
          </v-btn>
          <span v-else>{{ item.completed_at }}</span>          
        </td>
        <td>
          <v-btn
            @click="onEdit(item)"
            size="x-small"
            color="primary"
            variant="outlined"
          >
            {{ t('global.edit') }}
          </v-btn>
        </td>
        <td>
          <v-btn
            @click="onDelete(item)"
            size="x-small"
            color="error"
            variant="outlined"
          >
            {{ t('global.delete') }}
          </v-btn>
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
  onComplete: (task: Task) => void;
  onDelete: (task: Task) => void;
  onEdit: (task: Task) => void; // Új prop
}>()
</script>