<script setup lang="ts">
import { getCurrentRouteId } from 'services/router';
import { userStore } from '..';
import { computed } from 'vue';
import { ticketStore } from 'domains/tickets';

const userId = getCurrentRouteId();
const user = userStore.getters.byId(userId);
const tickets = computed(() => ticketStore.getters.all.value.filter((ticket) => ticket.user_id === userId));

userStore.actions.getAll();
ticketStore.actions.getAll();
</script>

<template>
  <div>
    <h4>Tickets by: {{ user?.first_name }}</h4>
      
      <div v-for="ticket in tickets" :key="ticket.id">
          <div class="view-to-show">
              <router-link :to="{ name: 'tickets.show', params: { id: ticket.id } }">
                  {{ ticket.title }}
              </router-link>
          </div>
      </div>
  </div>
</template>

<style>
/* @import 'style/shared/show.css'; */
</style>
