<script setup lang="ts">
import TicketForm from '../components/TicketForm.vue';
import Ticket from '../types';
import { ref } from 'vue';
import { ticketStore } from '..';
import { goToRoute } from 'services/router';

const ticket = ref<Ticket> ({
    id: NaN,
    user_id: NaN,
    assignee_id: NaN,
    status_id: NaN,
    title: "",
    content: "",
    created_at: "",
    updated_at: "",
    category_ids: []
});

const createTicket = async (ticketData: Ticket) => {
    await ticketStore.actions.create(ticketData);
    goToRoute('ticket.overview');
};
</script>

<template>
    <div>
        <ticket-form v-model="ticket" @submitTicket="createTicket" />
    </div>
</template>
