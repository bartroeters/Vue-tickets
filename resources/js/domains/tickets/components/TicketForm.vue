  <script setup lang="ts">
  import Ticket from '../types';
  import { ref } from 'vue';
  import { categoryStore } from 'domains/categories';

  const props = defineProps({
    ticket: { type: Object as () => Ticket }
  });

  defineEmits(['submitTicket']);

  const ticketData = ref({ ...props.ticket });

  const categories = categoryStore.getters.all;
  categoryStore.actions.getAll();
  </script>

  <template>
    <h2 class="form-title">Ticket Form</h2>

    <div class="form-wrapper">
      <form @submit.prevent="$emit('submitTicket', ticketData)">
        <div>
          <label for="title">Title:</label>
          <input name="title" id="title" v-model="ticketData.title" />
        </div>

        <div>
          <label for="user">User:</label>
          <input name="user" id="user" v-model="ticketData.userId" />
        </div>

        <div>
          <label for="assignee">Assignee:</label>
          <input name="assignee" id="assignee" v-model="ticketData.assigneeId" />
        </div>

        <div>
          <label for="status">Status:</label>
          <input name="status" id="status" v-model="ticketData.statusId" />
        </div>

        <div>
          <label for="content">Content:</label>
          <textarea
            name="content"
            id="content"
            @input="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"
            v-model="ticketData.content"
            style="width: 600px;">
          </textarea>
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
