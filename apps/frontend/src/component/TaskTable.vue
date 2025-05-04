<template>
  <div>
    <v-text-field
      v-model="search"
      :label="t('global.search')"
      class="mb-4"
      prepend-inner-icon="mdi-magnify"
      clearable
    />
    <v-table>
      <thead>
        <tr>
          <th class="text-left">✔</th>
          <th class="text-left">{{ t('task.description') }}</th>
          <th class="text-left">{{ t('task.user') }}</th>
          <th class="text-left">{{ t('task.estimatedTime') }}</th>
          <th class="text-left">{{ t('task.usedTime') }}</th>
          <th class="text-left">{{ t('task.completedAt') }}</th>
          <th class="text-left">{{ t('global.edit') }}</th>
          <th class="text-left">{{ t('global.delete') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in filteredItems" :key="item.id">
          <td>
            <input type="checkbox" :checked="item.selected" @change="event => onSelect(item, event.target.checked)" />
          </td>
          <td>{{ item.description }}</td>
          <td>{{ item.user?.name }}</td>
          <td>{{ item.estimatedTime }} {{ t('global.minutes') }}</td>
          <td>{{ item.usedTime }} {{ t('global.minutes') }}</td>
          <td>
            <v-btn
              v-if="!item.completedAt"
              @click="onComplete(item)"
              size="x-small"
              color="success"
              variant="outlined"
            >
              {{ t('task.complete') }}
            </v-btn>
            <span v-else>{{ item.completedAt }}</span>          
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
  </div>
</template>

<script setup lang="ts">
import { Task } from '@/lib/interfaces/task.interface';
import { useI18n } from 'vue-i18n';
import { ref, computed } from 'vue';

const { t } = useI18n();

const props = defineProps<{
  items: Task[],
  onSelect: (task: Task, selected: boolean) => void;
  onComplete: (task: Task) => void;
  onDelete: (task: Task) => void;
  onEdit: (task: Task) => void;
}>()


const search = ref('');

const filteredItems = computed(() => {
  const keyword = search.value.toLowerCase();
  return props.items.filter(item =>
    Object.values(item).some(value => {
      if (typeof value === 'string' || typeof value === 'number') {
        return value.toString().toLowerCase().includes(keyword);
      }
      if (typeof value === 'object' && value !== null) {
        return Object.values(value).some(v =>
          typeof v === 'string' && v.toLowerCase().includes(keyword)
        );
      }
      return false;
    })
  );
});
</script>