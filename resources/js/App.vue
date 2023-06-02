<script setup lang="ts">
import TheNavigation from 'components/TheNavigation.vue';
</script>

<template>
  <div class="app-container">
    <div class="sticky-navigation">
      <TheNavigation />
    </div>

    <div class="main-content-container">
      <div class="content-container">
        <RouterView />
      </div>
    </div>
  </div>
</template>