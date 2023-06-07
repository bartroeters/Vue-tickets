<script setup lang="ts">
import { PropType } from 'vue';
import Ticket from '../types';
import { categoryStore } from 'domains/categories';
import { showAllContent, toggleContent, getFormattedContent } from 'get-formatted-content';
import { userStore } from 'domains/users';
import Category from 'domains/categories/types';

const props = defineProps({
  tickets: { type: Array as PropType<Ticket[]> },
  categories: { type: Array as PropType<Category[]> }
});

const getCategoryTitle = (categoryId: number) => {
  return categoryStore.getters.byId(categoryId).value?.title;
};
</script>

<template>
  <div class="header-wrapper">
    <h2 class="sticky-title">All tickets ({{ tickets.length }})</h2>

    <button class="create-page-button">
      <router-link :to="{name: 'tickets.create'}">
        Create new ticket
      </router-link>
    </button>
  </div>

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
                  <span v-if="index === 0">&nbsp;</span>
                  <span>{{ getCategoryTitle(categoryId) }}</span>
                  <span v-if="index !== ticket.category_ids.length - 1">,&nbsp;</span>
                </span>
              </div>
            </td>
          </tr>

          <tr class="table-row-separator">
            <td colspan="5">
              <span class="button-wrapper">
                <div class="content-text" :class="{ 'show-more': showAllContent[ticket.id] }">
                  {{ getFormattedContent(ticket.content) }}
                </div>

                <button v-if="ticket.content.length" @click="toggleContent(ticket.id)" class="collapse-content-button">
                  {{ showAllContent[ticket.id] ? '&uarr; Show less' : 'Show more &darr;' }}
                </button>
                
                <span>
                  <button class="show-page-button">
                    <router-link :to="{name: 'tickets.show', params: {id: ticket.id}}">
                      &rarr; Read all
                    </router-link>
                  </button>

                  <button class="edit-page-button">
                    <router-link :to="{name: 'tickets.edit', params: {id: ticket.id}}">
                      Edit ticket
                    </router-link>
                  </button>
                </span>
              </span>
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
