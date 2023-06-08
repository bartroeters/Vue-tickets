<script setup lang="ts">
import { computed, ref } from 'vue';
import { ticketStore } from '..';
import { userStore } from 'domains/users';
import { categoryStore } from 'domains/categories';
import { getCurrentRouteId } from 'services/router';
import { statusStore } from 'domains/statuses';
import { responseStore } from 'domains/responses';
import { Response as ResponseType } from 'domains/responses/types';

const ticketId = getCurrentRouteId();
const ticket = ticketStore.getters.byId(ticketId);

const getCategoryTitle = (categoryId: number) => {
  return categoryStore.getters.byId(categoryId).value?.title;
};

const getUserFullName = (userId: number) => {
  return userStore.getters.byId(userId).value?.first_name;
};

const getStatusTitle = (statusId: number) => {
  return statusStore.getters.byId(statusId).value?.title;
};

const getResponseValue = (ticketId: number) => {
  const responses = responseStore.getters.all.value;
  return responses.find((responseType: ResponseType) => responseType.ticket_id === ticketId);
};

const responseLoaded = ref(false);
const response = ref(null);

responseStore.actions.getAll().then(() => {
  response.value = getResponseValue(ticketId);
  responseLoaded.value = true;
});

ticketStore.actions.getAll();
userStore.actions.getAll();
categoryStore.actions.getAll();
statusStore.actions.getAll();
</script>

<template>
  <div class="header-wrapper">
    <h2 class="sticky-title">{{ ticket.title }}</h2>

    <button class="back-to-previous-page-button">
      <router-link :to="{ name: 'tickets.overview' }">
        &larr; View all tickets
      </router-link>
    </button>
  </div>

  <div v-if="ticket" class="main-content-wrapper">
    <div class="title-section">
      <h6 class="title">Categories</h6>
      <div class="categories-wrapper">
        <div class="category" v-for="(categoryId, index) in ticket.category_ids" :key="index">
          <span v-if="index === 0">&nbsp;</span>
          <span>{{ getCategoryTitle(categoryId) }}</span>
          <span v-if="index !== ticket.category_ids.length - 1">,&nbsp;</span>
        </div>
      </div>
    </div>

    <div class="title-section">
      <h6 class="title smaller">Status</h6>
      <div class="status-title">{{ getStatusTitle(ticket.status_id) }}</div>
    </div>

    <div class="title-section">
      <h6 class="title">Description</h6>
      <div class="ticket-content">{{ ticket.content }}</div>
    </div>

    <div class="title-section">
      <h6 class="title">Response</h6>
      <div v-if="responseLoaded">
        <div class="user-info">
          <div class="info-label">User:</div>
          <div class="info-value">{{ getResponseValue(ticket.id)?.user_id }}</div>
        </div>

        <div class="ticket-details">
          <div class="detail-label">Created:</div>
          <div class="detail-value">{{ getResponseValue(ticket.id)?.created_at }}</div>
        </div>

        <div class="ticket-content">{{ getResponseValue(ticket.id)?.content }}</div>
      </div>

      <div v-else>
        <p class="no-response-available">No response available.</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import 'style/ticket/show.css';
</style>
