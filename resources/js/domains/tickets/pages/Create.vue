<script setup lang="ts">
import TicketForm from '../components/TicketForm.vue';
import Ticket from '../types';
import { ticketStore } from '..';
import { goToRoute } from 'services/router';

const createTicket = async (ticketData: Ticket) => {
    await ticketStore.actions.create(ticketData);
    goToRoute('tickets.overview');
};
</script>

<template>
    <ticket-form @submitTicket="createTicket" />
</template>
