<script setup lang="ts">
import { computed } from 'vue';
import { ticketStore } from '..';
import { userStore } from 'domains/users';
import { categoryStore } from 'domains/categories';
import { getCurrentRouteId } from 'services/router';

const ticketId = getCurrentRouteId();
const ticket = ticketStore.getters.byId(ticketId);
const user = computed(() => userStore.getters.byId(ticket.value?.user_id).value);

const getCategoryTitle = (categoryId: number) => {
  return categoryStore.getters.byId(categoryId).value?.title;
};

ticketStore.actions.getAll();
userStore.actions.getAll();
categoryStore.actions.getAll();
</script>

<template>
  <div v-if="ticket" class="show-page-wrapper">
    <div class="header-wrapper">
      <h2 class="sticky-title">{{ ticket.title }}</h2>

      <button class="back-to-previous-page-button">
        <router-link :to="{name: 'tickets.overview'}">
          &larr; View all tickets
        </router-link>
      </button>
    </div>

    <h4>{{ ticket.title }}</h4>
    
    <div>
        By
        <RouterLink :to="{ name: 'users.show', params: {id: ticket.user_id} }">
            {{ user?.first_name }}
        </RouterLink>
    </div>
    
    <h6>Description</h6>

    <div>{{ ticket.content }}</div>

    <h6>Categories</h6>

    <div>
      <span v-for="categoryId in ticket.category_ids" :key="categoryId">
        {{ getCategoryTitle(categoryId) }}
      </span>
    </div>
  </div>
</template>

<style scoped>
@import 'style/shared/show.css';
</style>
