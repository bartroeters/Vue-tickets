<script setup lang="ts">
import { ticketStore } from '..';
import { userStore } from 'domains/users';
import { categoryStore } from 'domains/categories';
import { getCurrentRouteId } from 'services/router';
import { statusStore } from 'domains/statuses';
import { responseStore } from 'domains/responses';
import { noteStore } from 'domains/notes';
import { getCategoryTitle, getUserFullName, getStatusTitle, getResponseValue, getNoteValue } from '..';
import { getLoggedInUser, loggedInUser } from '../../auth';
import { formatDate } from 'helpers/date-time-formatter';
import AddNoteForm from '../components/AddNoteForm.vue';

const ticketId = getCurrentRouteId();
const ticket = ticketStore.getters.byId(ticketId);

ticketStore.actions.getAll();
userStore.actions.getAll();
categoryStore.actions.getAll();
statusStore.actions.getAll();
responseStore.actions.getAll();
noteStore.actions.getAll();
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

    <h6 class="response-title">Response</h6>

    <div v-if="getResponseValue(ticket.id).length > 0">
      <div v-for="(response, index) in getResponseValue(ticket.id)" :key="index">
        <p>
          {{ response.content }}
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

            <span>{{ formatDate(response.createdAt) }}</span>
          </div>

          <div>
            <button class="edit-button">
              <router-link
                v-if="loggedInUser.isAdmin"
                :to="{name: 'responses.edit', params: {id: response.id}}"
                :ticket="ticket"
                >
                Edit response
              </router-link>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <div v-else style="margin-bottom: 2em;" class="response-separator">
      <p class="italic-font">No response yet.</p>

      <router-link
        v-if="loggedInUser.id === ticket.assigneeId"
        :to="{name: 'responses.create', params: { ticketId: ticketId}}"
        >
        Add response
      </router-link>
    </div>

    <add-note-form
        v-if="!(ticket.userId === getLoggedInUser?.id) && getLoggedInUser.isAdmin"
        :ticket="ticket"
      />

    <h6 class="note-title">Notes</h6>

    <div
      v-if="ticket.userId === getLoggedInUser?.id && getLoggedInUser.isAdmin && getNoteValue(ticket.id).length > 0"
      class="note-overview"
      >
      <p v-for="(note, index) in getNoteValue(ticket.id)" :key="index" class="note">
        {{ note.content }} ({{ formatDate(note.createdAt) }})
      </p>
    </div>
  </main>
</template>

<style scoped>
@import 'style/ticket/show.css';
</style>
