<script setup lang="ts">
import { useRoute } from 'vue-router';
import { getSortedTickets, ticketStore } from '..';
import { categoryStore } from 'domains/categories';
import TicketList from '../components/TicketList.vue';
import { computed } from 'vue';

const sortedTickets = computed(() => getSortedTickets());
const categories = categoryStore.getters.all;

const route = useRoute();
const categoryId = route.params.id as string;

const filteredTickets = computed(() => {
    if (categoryId) {
        return sortedTickets.value.filter(ticket => ticket.categoryIds.includes(parseInt(categoryId)));
    } else {
        return sortedTickets.value;
    }
});

ticketStore.actions.getAll();
categoryStore.actions.getAll();
</script>

<template>
    <!-- <ticket-list :tickets="sortedTickets" :categories="categories" /> -->
    <ticket-list :tickets="filteredTickets" :categories="categories" />
</template>