<script setup lang="ts">
import ResponseForm from '../components/ResponseForm.vue';
import { Response as ResponseType } from '../types';
import { ref } from 'vue';
import { responseStore } from '..';
import { goBack } from 'services/router';
import Ticket from '../../tickets/types';

const response = ref<ResponseType>({ id: NaN, userId: NaN, ticketId: NaN, content: "", createdAt: "", updatedAt: "" });

const addResponse = async (responseData: ResponseType) => {
    console.log(responseData);
     await responseStore.actions.create(responseData);
     goBack();
};

const props = defineProps({
    ticket: { type: Object as () => Ticket }
});

</script>

<template>
    <response-form :ticket="props.ticket" v-model="response" @submitResponse="addResponse" />
</template>