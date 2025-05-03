<template>
  <v-dialog v-model="visible" max-width="600">
    <v-card>
      <v-card-title>
        <span class="text-h6">{{ task?.id ? t('task.edit') : t('task.create') }}</span>
      </v-card-title>

      <v-card-text>
        <v-form ref="formRef" @submit.prevent="submit">
          <v-text-field
            v-model="form.description"
            :label="t('task.description')"
            required
          ></v-text-field>

          <v-select
            v-model="form.user_id"
            :label="t('task.user')"
            :items="users"
            item-value="id"
            item-title="name"
            required
          ></v-select>

          <v-text-field
            v-model.number="form.estimated_time"
            :label="t('task.estimated_time')"
            type="number"
            min="0"
            suffix="min"
            required
          ></v-text-field>

          <v-text-field
            v-model.number="form.used_time"
            :label="t('task.used_time')"
            type="number"
            min="0"
            suffix="min"
            required
          ></v-text-field>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="cancel">{{ t('global.cancel') }}</v-btn>
        <v-btn color="primary" @click="submit">{{ t('global.save') }}</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, watch, reactive } from 'vue';
import { Task } from '@/lib/interfaces/task.interface';
import { User } from '@/lib/interfaces/user.interface';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps<{
  modelValue: boolean;
  task?: Task | null;
  users: User[];
}>();

const emit = defineEmits<{
  (e: 'update:modelValue', val: boolean): void;
  (e: 'save', taskData: Partial<Task>): void;
}>();

const visible = ref(props.modelValue);
watch(() => props.modelValue, val => visible.value = val);
watch(visible, val => emit('update:modelValue', val));

const form = reactive<Partial<Task>>({});

watch(() => props.task, (val) => {
  if (val) {
    Object.assign(form, val);
  } else {
    Object.assign(form, {
      description: '',
      user_id: undefined,
      estimated_time: 0,
      used_time: 0,
    });
  }
}, { immediate: true });

const cancel = () => {
  visible.value = false;
};

const submit = () => {
  emit('save', { ...form });
  visible.value = false;
};
</script>