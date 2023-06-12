<script setup lang="ts">
import { getCurrentRouteId } from 'services/router';
import { userStore } from '..';
import { computed } from 'vue';
import { ticketStore } from 'domains/tickets';

const userId = getCurrentRouteId();
const user = userStore.getters.byId(userId);
const tickets = computed(() => ticketStore.getters.all.value.filter((ticket) => ticket.userId === userId));

userStore.actions.getAll();
ticketStore.actions.getAll();
</script>

<template>
  <header class="header-wrapper">
    <h2>{{ user?.firstName }} {{ user?.lastName }}</h2>

    <button class="link-to-previous-page">
      <router-link :to="{ name: 'tickets.overview' }">
        &larr; View all tickets
      </router-link>
    </button>
  </header>

  <main v-if="user" class="main-content-wrapper">
    <div class="user-details-wrapper">
      
        <h2>User Details</h2>

        <div>
          <div>ID: {{ user.id }}</div>
          <div>First Name: {{ user.firstName }}</div>
          <div>Last Name: {{ user.lastName }}</div>
          <div>Email: {{ user.email }}</div>
          <div>Phone Number: {{ user.phonenumber }}</div>
          <div>Is Admin: {{ user.isAdmin ? 'Yes' : 'No' }}</div>
        </div>
      </div>

      <div>
        <!-- <div class="status-wrapper">
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
        </div> -->
    </div>

    <div class="response-separator">
      <!-- <p>{{ ticket.content }}</p> -->
    </div>
  </main>
</template>

<style>
@import 'style/user/show.css';
</style>
