<script setup lang="ts">
import { goToRoute } from 'services/router';
import { categoryStore } from '..';
import CategoryForm from '../components/CategoryForm.vue';
import Category from '../types';

const createCategory = async (categoryData: Category) => {
    await categoryStore.actions.create(categoryData);
    goToRoute('categories.overview');
};
</script>

<template>
    <category-form @submitCategory="createCategory" />
</template>
