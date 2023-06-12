<script setup lang="ts">
import { getSortedTickets, ticketStore } from '..';
import { categoryStore } from 'domains/categories';
import TicketList from '../components/TicketList.vue';
import { computed } from 'vue';

const sortedTickets = computed(() => getSortedTickets());
const categories = categoryStore.getters.all;

ticketStore.actions.getAll();
categoryStore.actions.getAll();
</script>

<template>
    <ticket-list :tickets="sortedTickets" :categories="categories" />
</template>