<script setup lang="ts">
import { type PropType, ref } from 'vue';
import Ticket from '../types';
import { categoryStore } from '../../categories';

const props = defineProps({
    tickets: { type: Array as PropType<Ticket[]> }
});

const categories = categoryStore.getters.all;
categoryStore.actions.getAll();

const showAllContent = ref<Record<number, boolean>>({});

const toggleContent = (ticketId: number): void => {
    showAllContent.value[ticketId] = !showAllContent.value[ticketId];
};

function getFormattedContent(content: string) {
    if (showAllContent.value) {
        return content;
    } else {
        const lines = content.split('\n');
        const truncatedContent = lines.slice(0, 4).join('\n');
        const remainingLines = lines.length - 4;
        return truncatedContent + (remainingLines > 0 ? `\n+ ${remainingLines} more line(s)` : '');
    }
};
</script>

<template>
    <h3>All tickets ({{ tickets.length }})</h3>
    
    <table class="ticket-table">
        <thead>
            <tr>
                <th class="small-width">ID</th>
                <th>User</th>
                <th>Assignee</th>
                <th class="small-width">Status</th>
                <th>Title</th>
                <th>Categories</th>
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
                    <td v-for="category in categories" :key="category.id">
                        {{ category.title }}
                    </td>
                </tr>

                <tr >
                    <td colspan="6">
                        <div class="content-text" :class="{ 'show-all': showAllContent[ticket.id] }">
                            {{ getFormattedContent(ticket.content) }}
                        </div>

                        <button v-if="ticket.content.length > 4" @click="toggleContent(ticket.id)" class="show-button">
                            {{ showAllContent[ticket.id] ? 'Show less' : 'Show all' }}
                        </button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<style scoped>
.ticket-table {
  width: 100%;
  border-collapse: collapse;
}

.ticket-table th,
.ticket-table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.ticket-table th.small-width,
.ticket-table td.small-width {
  width: 50px;
}

.content-text {
  max-height: 80px;
  overflow: hidden;
  position: relative;
  white-space: pre-wrap;
  word-wrap: break-word;
}

.content-text.show-all {
  max-height: none;
}

.show-button {
  background-color: transparent;
  border: none;
}

.show-button:focus {
  outline: none;
}
</style>
