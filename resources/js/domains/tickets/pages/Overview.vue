<script setup lang="ts">
import { ticketStore } from '..';
import TicketList from '../components/TicketList.vue';

const tickets = ticketStore.getters.all;

ticketStore.actions.getAll();
</script>

<template>
    <ticket-list :tickets="tickets" />
</template>