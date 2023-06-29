<script setup lang="ts">
import CategoryForm from '../components/CategoryForm.vue';
import { getCurrentRouteId, goToRoute } from 'services/router';
import { categoryStore } from '..';
import Category from '../types';

const categoryId = getCurrentRouteId();
const category = categoryStore.getters.byId(categoryId);

const editCategory = async (categoryData: Category) => {
    await categoryStore.actions.update(categoryId, categoryData);
    goToRoute('categories.overview');
};
</script>

<template>
    <category-form :category="category" @submitCategory="editCategory"/>
</template>