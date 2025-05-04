<template>
    <v-app-bar flat>
        <v-container class="mx-auto d-flex align-center justify-center">
          <v-avatar class="me-4 " color="grey-darken-1" size="32"></v-avatar>
          <v-btn v-for="link in links" :key="link.key" :text="link.text" :to="link.to" variant="text"></v-btn>
          <v-spacer></v-spacer>
        </v-container>
    </v-app-bar>
</template>

<script lang="ts" setup>
import { useI18n } from 'vue-i18n'; 
const { t } = useI18n();

interface Link {
  text: string;
  key: string;
  to: string;
};

const links: Link[] = [
  {
    text: 'Tasks',
    key: 'tasks',
    to: '/'
  },
]
</script>