<script setup lang="ts">
import { ref } from 'vue';
import { noteStore } from '../../notes';
import { Note } from '../../notes/types';
import { resizeTextarea } from 'components/form/resize-text-area';
import { getLoggedInUser } from '../../auth';
import Ticket from '../types';

const props = defineProps({
  note: { type: Object as () => Note },
  ticket: { type: Object as () => Ticket}
});

defineEmits(['submitNote']);

const addNote = async () => {
    await noteStore.actions.create(noteData.value);
};

const noteData = ref({
    ...props.note,
    userId: getLoggedInUser.value.id,
    ticketId: props.ticket.id
});
</script>

<template>
    <form @submit.prevent="addNote">
      <div>
        <label for="content">Content:</label>

        <textarea
          name="content"
          id="content"
          @input="resizeTextarea"
          v-model="noteData.content"
          style="width: 600px; resize: vertical;"
        ></textarea>
      </div>

      <div class="button-wrapper">
        <button>Submit</button>
      </div>
    </form>
</template>

<style scoped>
@import 'style/shared/form.css';
</style>
