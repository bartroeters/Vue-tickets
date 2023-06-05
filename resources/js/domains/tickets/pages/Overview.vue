<script setup lang="ts">
import { ticketStore } from '..';
import { categoryStore } from 'domains/categories';
import TicketList from '../components/TicketList.vue';

const tickets = ticketStore.getters.all;
ticketStore.actions.getAll();
const categories = categoryStore.getters.all;
categoryStore.actions.getAll();
</script>

<template>
    <ticket-list :tickets="tickets" :categories="categories" />
</template>