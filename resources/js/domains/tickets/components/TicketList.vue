<script setup lang="ts">
import { PropType, defineProps } from 'vue';
import Ticket from '../types';
import { categoryStore } from '../../categories';
import { showAllContent, toggleContent, getFormattedContent } from 'get-formatted-content';

const props = defineProps({
  tickets: { type: Array as PropType<Ticket[]> }
});

const categories = categoryStore.getters.all;
categoryStore.actions.getAll();
</script>

<template>
    <div class="container">
        <div class="title-container">
            <h3 class="title">All tickets ({{ tickets.length }})</h3>
        </div>

        <div class="table-container">
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
                            <td>{{ ticket.user_id }}</td>
                            <td>{{ ticket.assignee_id }}</td>
                            <td class="small-width">{{ ticket.status_id }}</td>
                            <td>{{ ticket.title }}</td>
                        </tr>

                        <tr>
                            <td colspan="6">
                                <div class="category-row">
                                    <span class="category-label">Categories:</span>
                                    <span v-for="category in categories" :key="category.id" class="category">
                                    {{ category.title }}
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" class="ticket-separator">
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
    </div>
</template>

<style scoped>
.container {
  position: relative;
  height: 100%;
  width: 100%;
}

.title-container {
  background-color: #202020;
  color: #fff;
  padding: 10px;
}

.title {
  font-size: 34px;
  text-transform: capitalize;
  letter-spacing: 1px;
  margin: 0;
}

.table-container {
  max-height: max-content;
  /* overflow: auto; */
}

.overview-table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  position: sticky;
  top: 0;
  background-color: #202020;
  color: #fff;
}

.overview-table th,
.overview-table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #444;
}

.overview-table th {
    font-size: 19px;
}

.overview-table th.small-width {
  width: 8%;
}

.overview-table td:nth-child(2),
.overview-table td:nth-child(3) {
  width: 21%;
}

.overview-table td.small-width {
  width: 17%;
}

.overview-table td:nth-child(5) {
  width: 33%;
}

.category-label {
  color: #bbb;
}

.category {
  background-color: #333;
  color: #fff;
  padding: 2px 6px;
  border-radius: 3px;
  margin-right: 5px;
}

.content-text {
  max-height: 54px;
  overflow: hidden;
  position: relative;
  white-space: pre-wrap;
  word-wrap: break-word;
}

.content-text.show-more {
  max-height: none;
}

.show-button {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 5px 10px;
  font-size: 12px;
  cursor: pointer;
  margin-top: 5px;
}

.show-button:hover {
  background-color: #555;
}

.table-container .ticket-separator {
    border-bottom: 3px solid #444;
}
</style>
