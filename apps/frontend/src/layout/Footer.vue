<template>
    <v-col>
        <p class="text-center">Task Manager {{currentYear}}</p>
    </v-col>
</template>

<script setup lang="ts">
const currentYear = new Date().getFullYear();
</script>
