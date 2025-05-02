<template>
  <v-app id="librepm">
    <Header />
    <v-main>
      <v-container>
        <v-row>
          <Main />
        </v-row>
        <v-row>
          <Footer />
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script lang="ts" setup>
import Header from '@/layout/Header.vue';
import Main from '@/layout/Main.vue';
import Footer from '@/layout/Footer.vue';

</script>
