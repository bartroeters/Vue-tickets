<script setup lang="ts">
import { getCurrentRouteId, goBack, goToRoute } from 'services/router';
import { responseStore } from '..';
import { Response as ResponseType } from '../types';
import ResponseForm from '../components/ResponseForm.vue';

const responseId = getCurrentRouteId();
const response = responseStore.getters.byId(responseId);

const editResponse = async (responseData: ResponseType) => {
    await responseStore.actions.update(responseId, responseData);
    goBack();
}
</script>

<template>
    <response-form :response="response" @submitResponse="editResponse" />
</template>
