<script setup lang="ts">
import TicketForm from '../components/TicketForm.vue';
import Ticket from '../types';
import { ref } from 'vue';
import { ticketStore } from '..';
import { goToRoute } from 'services/router';

const ticket = ref<Ticket> ({
    id: NaN,
    userId: NaN,
    assigneeId: NaN,
    statusId: NaN,
    title: "",
    content: "",
    createdAt: "",
    updatedAt: "",
    categoryIds: []
});

const createTicket = async (ticketData: Ticket) => {
    await ticketStore.actions.create(ticketData);
    goToRoute('tickets.overview');
};
</script>

<template>
    <div>
        <ticket-form v-model="ticket" @submitTicket="createTicket" />
    </div>
</template>
