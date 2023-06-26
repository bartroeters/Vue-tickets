<script setup lang="ts">
import { computed, ref } from 'vue';
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

const ticketData = ref({
  ...props.ticket,
  statusId: 2
});

const isAssigneeSelected = computed(() => ticketData.value.assigneeId !== null);

const admins = userStore.getters.all.value.filter(user => user.isAdmin);
</script>

<template>
  <form @submit.prevent="designateAssignee">
    <select name="admins" id="admins" v-model="ticketData.assigneeId">
      <option v-for="admin in admins" :value="admin.id" :key="admin.id">
          {{ getUserFullName(admin.id) }}
      </option>
    </select>

    <button type="submit" :disabled="!isAssigneeSelected">Designate assignee</button>
  </form>
</template>