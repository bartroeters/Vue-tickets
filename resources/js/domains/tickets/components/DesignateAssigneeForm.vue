<script setup lang="ts">
import { ref } from 'vue';
import Ticket from '../types';
import { getUserFullName, ticketStore } from '..';
import { userStore } from 'domains/users';

const props = defineProps({
  ticket: { type: Object as () => Ticket }
});

defineEmits(['submitTicket']);

const designateAssignee = async () => {
  await ticketStore.actions.update(props.ticket?.id, ticketData.value);
};

const users = userStore.getters.all.value.filter(user => user.isAdmin);

const ticketData = ref({
  ...props.ticket,
  statusId: 2
});
</script>

<template>
  <form @submit.prevent="designateAssignee">
    <select name="users" id="users" v-model="ticketData.assigneeId">
      <option v-for="user in users" :value="user.id" :key="user.id">
          {{ getUserFullName(user.id) }}
      </option>
    </select>

    <button type="submit">Designate assignee</button>
  </form>
</template>