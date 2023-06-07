<script setup lang="ts">
import TicketForm from '../components/TicketForm.vue';
import { getCurrentRouteId, goToRoute } from 'services/router';
import { ticketStore } from '..';
import Ticket from '../types';

const ticketId = getCurrentRouteId();
const ticket = ticketStore.getters.byId(ticketId);

const editTicket = async (ticketData: Ticket) => {
    await ticketStore.actions.update(ticketId, ticketData);
    goToRoute('tickets.overview');
};
</script>

<template>
    <ticket-form :ticket="ticket" @submitTicket="editTicket"/>
</template>