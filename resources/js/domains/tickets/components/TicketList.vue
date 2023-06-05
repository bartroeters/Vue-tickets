<script setup lang="ts">
import { PropType } from 'vue';
import Ticket from '../types';
import { categoryStore } from 'domains/categories';
import { showAllContent, toggleContent, getFormattedContent } from 'get-formatted-content';
import { userStore } from 'domains/users';

const props = defineProps({
  tickets: { type: Array as PropType<Ticket[]> }
});

const getCategoryTitle = (categoryId: number) => {
  return categoryStore.getters.byId(categoryId).value?.title;
};

// categoryStore.getters.all;
// categoryStore.actions.getAll();
</script>

<template>
  <h2 class="sticky-title">All tickets ({{ tickets.length }})</h2>

  <div class="table-wrapper">
    <table class="overview-table">
      <thead>
        <tr>
          <th class="small-width">ID</th>
          <th>User</th>
          <th>Assignee</th>
          <th class="small-width">Status</th>
          <th>Title</th>
        </tr>
      </thead>

      <tbody>
        <template v-for="ticket in props.tickets" :key="ticket.id">
          <tr>
            <td class="small-width">{{ ticket.id }}</td>
            <td>{{ userStore.getters.byId(ticket.user_id).value?.last_name }}</td>
            <td>{{ ticket.assignee_id }}</td>
            <td class="small-width">{{ ticket.status_id }}</td>
            <td>{{ ticket.title }}</td>
          </tr>

          <tr>
            <td colspan="5">
              <div class="category-row">
                <span>Categories:</span>
                <span class="category" v-for="(categoryId, index) in ticket.category_ids" :key="index">
                  <span v-if="index == 0">&nbsp;</span>
                    {{ getCategoryTitle(categoryId) }},
                  </span>
              </div>
            </td>
          </tr>

          <tr class="ticket-separator">
            <td colspan="6">
              <div class="content-text" :class="{ 'show-more': showAllContent[ticket.id] }">
                {{ getFormattedContent(ticket.content) }}
              </div>

              <button v-if="ticket.content.length" @click="toggleContent(ticket.id)" class="show-button">
                {{ showAllContent[ticket.id] ? 'Show less' : 'Show more' }}
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
@import 'style/shared/overview.css';
@import 'style/ticket/overview.css';
</style>
