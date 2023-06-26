<script setup lang="ts">
import ResponseForm from '../components/ResponseForm.vue';
import { Response as ResponseType } from '../types';
import { ref } from 'vue';
import { responseStore } from '..';
import { goBack } from 'services/router';
import { getLoggedInUser } from 'domains/auth';
import { useRoute } from 'vue-router'
import Ticket from '../../tickets/types';
import { updateStatus } from 'domains/tickets';

const route = useRoute();

const props = defineProps({
    ticket: { type: Object as () => Ticket }
});

const response = ref<ResponseType>({
    id: NaN,
    userId: getLoggedInUser.value.id,
    ticketId: Number.parseInt(route.params.ticketId as string),
    content: "",
    createdAt: "",
    updatedAt: "" 
});

const addResponse = async (responseData: ResponseType) => {
    await responseStore.actions.create(responseData);
    const updatedTicket = await updateStatus(Number.parseInt(route.params.ticketId as string), 3);
    if (updatedTicket) {
        goBack();
    };
};
</script>

<template>
    <response-form
        v-model="response"
        :response="response"
        :ticket="props.ticket"
        @submitResponse="addResponse"
    />
</template>