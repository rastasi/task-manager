<template>
    <v-table>
      <thead>
        <tr>
          <th class="text-left">
            {{ t('task.key') }}
          </th>
          <th class="text-left">
            {{ t('task.summary') }}
          </th>
          <th class="text-left">
            {{ t('task.status') }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in items"
          :key="item.id"
        >
          <td>{{ item.key }}</td>
          <td><router-link :to="`/task/${item.id}`">{{ item.summary }}</router-link></td>
          <td>{{ item.status.name }}</td>
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