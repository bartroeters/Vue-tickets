<script setup lang="ts">
import { ticketStore } from '..';
import { userStore } from 'domains/users';
import { categoryStore } from 'domains/categories';
import { getCurrentRouteId } from 'services/router';
import { statusStore } from 'domains/statuses';
import { responseStore } from 'domains/responses';
import { getCategoryTitle, getUserFullName, getStatusTitle, getResponseValue } from '..';
import { loggedInUser } from '../../auth';
import { Response as ResponseType } from 'domains/responses/types';

const ticketId = getCurrentRouteId();
const ticket = ticketStore.getters.byId(ticketId);

ticketStore.actions.getAll();
userStore.actions.getAll();
categoryStore.actions.getAll();
statusStore.actions.getAll();
responseStore.actions.getAll();

const formatDate = (dateString: string) => {
  const date = new Date(dateString);
  const formattedDate = date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    second: 'numeric'
  });
  return formattedDate;
};

const formatDateDebug = (dateString: string) => {
  console.log('Raw date:', dateString);
  return dateString;
};

const responseValueDebug = (response: ResponseType) => {
  console.log('Response:', response);
  return response;
};
</script>

<template>
  <header class="header-wrapper">
    <h2>{{ ticket?.title }}</h2>

    <button class="link-to-previous-page">
      <router-link :to="{ name: 'tickets.overview' }">
        &larr; View all tickets
      </router-link>
    </button>
  </header>

  <main v-if="ticket" class="main-content-wrapper">
    <div class="ticket-details-wrapper">
      <div class="categories-wrapper">
        <h6>Categories</h6>

        <div class="category" v-for="(categoryId, index) in ticket.categoryIds" :key="index">
          <router-link :to="{name: 'categories.overview'}">
            {{ getCategoryTitle(categoryId) }}
          </router-link>
        </div>
      </div>

      <div>
        <div class="status-wrapper">
          <div>Status:&nbsp;</div>
          <div class="italic-font">{{ getStatusTitle(ticket.statusId) }}</div>
        </div>

        <div class="name-wrapper">
          <div>Submitted by:&nbsp</div>
          <div class="italic-font">
            <router-link :to="{name: `users.overview`}">
              {{ getUserFullName(ticket.userId) }}
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="response-separator">
      <p>{{ ticket.content }}</p>
    </div>

    <div>
      <h6 class="response-title">Response</h6>
    </div>

    <div v-if="getResponseValue(ticket.id).length > 0">
      <div v-for="(response, index) in getResponseValue(ticket.id)" :key="index">
        <p>
          {{ responseValueDebug(response) }}
        </p>

        <div class="response-details">
          <div>
            <span>Response by:&nbsp;</span>

            <span class="italic-font">
              <router-link :to="{name: `users.overview`}">
                {{ getUserFullName(response.userId) }}
              </router-link>
            </span>

            <span>, uploaded:&nbsp;</span>

            <span>{{ response.createdAt }}</span>
          </div>
        </div>

        <!-- <p class="response">{{ formatDate(response.createdAt) }}</p> -->
        <!-- <p class="response">{{ formatDateDebug(response.createdAt) }}</p> -->
      </div>
    </div>

    <div v-else style="margin-bottom: 2em;">
      <p class="italic-font">No response yet.</p>
    </div>

    <router-link
        v-if="loggedInUser.id === ticket.assigneeId"
        :to="{name: 'responses.create', params: { ticketId: ticketId}}"
        >
        Add response
      </router-link>
  </main>
</template>

<style scoped>
@import 'style/ticket/show.css';
</style>
