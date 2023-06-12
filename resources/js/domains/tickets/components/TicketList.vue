<script setup lang="ts">
import { PropType } from 'vue';
import Ticket from '../types';
import { showAllContent, toggleContent, getFormattedContent } from 'get-formatted-content';
import Category from 'domains/categories/types';
import { getCategoryTitle, getUserFullName, getStatusTitle } from '..';
import { userStore } from '../../users';
import { statusStore } from '../../statuses';

const props = defineProps({
  tickets: { type: Array as PropType<Ticket[]> },
  categories: { type: Array as PropType<Category[]> }
});

userStore.actions.getAll();
statusStore.actions.getAll();
</script>

<template>
  <div class="header-wrapper">
    <h2>All tickets ({{ tickets.length }})</h2>

    <div>
      <button class="link-to-create-page">
        <router-link :to="{name: 'tickets.create'}">
          Create new ticket
        </router-link>
      </button>
    </div>
  </div>

  <div class="table-wrapper">
    <table class="overview-table">
      <thead>
        <tr>
          <th class="small-width">ID</th>
          <th>Submitter</th>
          <th>Assignee</th>
          <th class="small-width">Status</th>
          <th>Title</th>
        </tr>
      </thead>

      <tbody>
        <template v-for="ticket in props.tickets" :key="ticket.id">
          <tr>
            <td class="small-width">{{ ticket.id }}</td>
            <td>
              <router-link :to="{name: 'users.overview'}">
                {{ getUserFullName(ticket.userId) }}
              </router-link>
            </td>
            <td>
              <router-link :to="{name: 'users.overview'}">
                {{ getUserFullName(ticket.assigneeId) }}
              </router-link>
            </td>
            <td class="small-width">{{ getStatusTitle(ticket.statusId) }}</td>
            <td>{{ ticket.title }}</td>
          </tr>
          
          <tr>
            <td colspan="5">
              <div class="category-row">
                <span>Categories:&nbsp;</span>

                <div class="category" v-for="(categoryId, index) in ticket.categoryIds" :key="index">
                  <router-link :to="{name: 'categories.overview'}">
                    {{ getCategoryTitle(categoryId) }}
                  </router-link>
                </div>

                <span class="date">{{ new Date(ticket.createdAt).toLocaleString() }}</span>
              </div>
            </td>
          </tr>

          <tr class="table-row-separator">
            <td colspan="5">
              <span class="button-wrapper">
                <div class="formatted-content" :class="{ 'show-more': showAllContent[ticket.id] }">
                  {{ getFormattedContent(ticket.content) }}
                </div>

                <button v-if="ticket.content.length" @click="toggleContent(ticket.id)" class="toggle-content-button">
                  {{ showAllContent[ticket.id] ? '&uarr; Show less' : 'Show more &darr;' }}
                </button>
                
                <span>
                  <button class="link-to-show-page">
                    <router-link :to="{name: 'tickets.show', params: {id: ticket.id}}">
                      &rarr; Read all
                    </router-link>
                  </button>

                  <button class="link-to-edit-page">
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
