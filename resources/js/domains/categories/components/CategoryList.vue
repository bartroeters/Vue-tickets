<script setup lang="ts">
import { PropType, computed } from 'vue';
import Category from '../types';
import { ticketStore } from 'domains/tickets';
import Ticket from '../../tickets/types';

const props = defineProps({
    categories: { type: Array as PropType<Category[]> }
});

const tickets = computed(() => ticketStore.getters.all.value);

const getCategoryTicketCount = (categoryId: number) => {
    return tickets.value.filter((ticket: Ticket) => ticket.categoryIds.includes(categoryId)).length;
};
</script>

<template>
    <div class="category-list">
        <div v-for="category in categories" :key="category.id" class="category-item">
            <router-link :to="{name: 'tickets.show', params: {id: category.id}}" class="category-link">
                <div class="category-title">{{ category.title }}</div>
                <div class="category-ticket-count">{{ getCategoryTicketCount(category.id) }} Tickets</div>
            </router-link>
        </div>
    </div>
</template>
  
<style scoped>
@import 'style/categories-overview.css';
</style>
