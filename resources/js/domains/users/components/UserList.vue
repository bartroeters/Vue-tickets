<script setup lang="ts">
import { PropType } from 'vue';
import User from '../types';
import { userStore } from '..';

const props = defineProps({
    users: {type: Array as PropType<User[]>}
});

const deleteUser = (id: number) => {
    userStore.actions.delete(id);
}
</script>

<template>
  <div class="user-list table-wrapper">
    <table class="user-table overview-table">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Admin</th>
          <th>Phone</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.firstName }}</td>
          <td>{{ user.lastName }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.isAdmin ? 'Yes' : 'No' }}</td>
          <td>{{ user.phonenumber }}</td>
          <td>
              <router-link
                :to="{name: 'users.edit', params: {id: user.id}}"
                style="color: rgb(64, 64, 230); text-decoration: none;"
                >
                  edit
              </router-link>
          </td>

          <td>
              <a @click="deleteUser(user.id)" class="delete-button">
                delete
              </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
@import 'style/shared/overview.css';
@import 'style/user/overview.css';
</style>