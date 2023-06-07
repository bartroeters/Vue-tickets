<script setup lang="ts">
import { ticketStore } from '..';
import { categoryStore } from 'domains/categories';
import TicketList from '../components/TicketList.vue';

const tickets = ticketStore.getters.all;
const categories = categoryStore.getters.all;

ticketStore.actions.getAll();
categoryStore.actions.getAll();
</script>

<template>
    <ticket-list :tickets="tickets" :categories="categories" />
</template>