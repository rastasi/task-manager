<template>
  <v-dialog v-model="taskFormDialogStore.visible" max-width="600">
    <v-card>
      <v-card-title>
        <span class="text-h6">{{ isEditing ? t('task.edit') : t('task.create') }}</span>
      </v-card-title>

      <v-card-text>
        <v-form @submit.prevent="handleSubmit" ref="form">
          <v-text-field
            v-model="taskStore.current.description"
            :label="t('task.description')"
            :rules="[requiredRule]"
          ></v-text-field>

          <v-select
            v-model="taskStore.current.user_id"
            :label="t('task.user')"
            :items="users"
            item-value="id"
            item-title="name"
            :rules="[requiredRule]"

          ></v-select>

          <v-text-field
            v-model.number="taskStore.current.estimated_time"
            :label="t('task.estimated_time')"
            type="number"
            min="0"
            suffix="min"
            :rules="[requiredRule]"
          ></v-text-field>

          <v-text-field
            v-model.number="taskStore.current.used_time"
            :label="t('task.used_time')"
            type="number"
            min="0"
            suffix="min"
            :rules="[requiredRule]"
          ></v-text-field>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="handleCancel">{{ t('global.cancel') }}</v-btn>
        <v-btn color="primary" @click="handleSubmit">{{ t('global.save') }}</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useTaskStore } from '@/store/task.store';
import { User } from '@/lib/interfaces/user.interface';
import { useTaskFormDialogStore } from '@/store/taskFormDialog.store';
import { requiredRule } from '@/lib/formRule';
import type { VForm } from 'vuetify/components';

const { t } = useI18n();
const taskStore = useTaskStore();
const taskFormDialogStore = useTaskFormDialogStore();
const form = ref<VForm | null>(null);

const props = defineProps<{
  users: User[];
  onSubmit: () => void;
}>();

const isEditing = computed(() => !!taskStore.current?.id);

const handleCancel = () => {
  taskFormDialogStore.close();
};

const handleSubmit = async () => {
  const vform = form.value as VForm;
  const { valid } = await vform.validate();
    if (valid) {
      props.onSubmit();
      taskFormDialogStore.close();
    }
  
};
</script>