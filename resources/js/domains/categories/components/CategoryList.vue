<script setup lang="ts">
import { getCategoryTicketCount, getSortedCategories } from '..';
import { getCategoryTicketsRoute } from 'domains/tickets';
import { categoryStore } from '..';
import Category from '../types';
import { PropType } from 'vue';
import Ticket from '../../tickets/types';

const props = defineProps({
    categories: { type: Array as PropType<Category[]> }
});

const categories = categoryStore.actions.getAll();
</script>

<template>
    <div class="header-wrapper">
        <h2>All categories</h2>
    </div>
    <div class="category-list">
        <div v-for="category in getSortedCategories()" :key="category.id" class="category-item">
            <router-link :to="getCategoryTicketsRoute(category.id)" class="category-link">
                <div style="display: flex; justify-content: space-between;">
                    <div class="category-title">{{ category.title }}</div>

                    <router-link :to="{name: 'categories.edit', params: {id: category.id}}">
                        edit
                    </router-link>
                </div>
                <div class="category-ticket-count">{{ getCategoryTicketCount(category) }} Tickets</div>
            </router-link>
        </div>
    </div>
</template>
  
<style scoped>
@import 'style/categories-overview.css';
</style>
