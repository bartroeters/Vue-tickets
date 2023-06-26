<script setup lang="ts">
import { categoryStore } from '..';
import CategoryList from '../components/CategoryList.vue';

const categories = categoryStore.getters.all;
categoryStore.actions.getAll();
</script>

<template>
    <category-list :categories="categories" />
</template>
