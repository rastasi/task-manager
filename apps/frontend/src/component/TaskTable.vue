<template>
    <v-table>
      <thead>
        <tr>
          <th class="text-left">
            {{ t('task.description') }}
          </th>
          <th class="text-left">
            {{ t('task.user_id') }}
          </th>
          <th class="text-left">
            {{ t('task.estimated_time') }}
          </th>
          <th class="text-left">
            {{ t('task.used_time') }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in items"
          :key="item.id"
        >
          <td>{{ item.description }}</td>
          <td>{{ item.user_id }}</td>
          <td>{{ item.estimated_time }}</td>
          <td>{{ item.used_time }}</td>
        </tr>
      </tbody>
    </v-table>
</template>

<script setup lang="ts">
import { Task } from '@/lib/interfaces/task.interface';
import { useI18n } from 'vue-i18n'

const { t } = useI18n();

defineProps<{
    items: Task[]
}>()

</script>