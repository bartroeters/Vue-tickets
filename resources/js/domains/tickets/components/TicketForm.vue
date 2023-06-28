<script setup lang="ts">
import Ticket from '../types';
import { ref } from 'vue';
import { categoryStore } from 'domains/categories';
import { resizeTextarea } from 'components/form/resize-text-area';
import { useRoute } from 'vue-router';
import { getLoggedInUser } from '../../auth';

const props = defineProps({
  ticket: { type: Object as () => Ticket }
});

defineEmits(['submitTicket']);

const categories = categoryStore.getters.all;
categoryStore.actions.getAll();

const createTicket: boolean = useRoute().name === "tickets.create";

const ticketData = ref({
  ...props.ticket,
  userId: createTicket ? getLoggedInUser.value.id : props.ticket?.userId,
  assigneeId: createTicket ? null : props.ticket.assigneeId,
  statusId: createTicket ? 1 : props.ticket.statusId,
  categoryIds: []
});
</script>

<template>
  <h2 class="form-title">Add ticket</h2>

  <div class="form-wrapper">
    <form @submit.prevent="$emit('submitTicket', ticketData)">
      <div>
        <label for="title">Title:</label>

        <input name="title" id="title" v-model="ticketData.title" />
      </div>

      <div>
        <label for="content">Content:</label>

        <textarea
          name="content"
          id="content"
          @input="resizeTextarea"
          v-model="ticketData.content"
          style="width: 600px; resize: vertical;"
        ></textarea>
      </div>

      <div>
        <label for="categories">Categories:</label>
        
        <select name="categories" id="categories" v-model="ticketData.categoryIds" multiple>
          <option v-for="category in categories" :value="category.id" :key="category.id">
            {{ category.title }}
          </option>
        </select>
      </div>

      <div class="button-wrapper">
        <button>Submit</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
@import 'style/shared/form.css';
</style>
