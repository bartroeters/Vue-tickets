<script setup lang="ts">
import { useRoute } from 'vue-router';
import User from '../types';
import { ref } from 'vue';
import { isEditRoute } from 'helpers/is-create-route';

const props = defineProps({
  user: { type: Object as () => User }
});

defineEmits(['submitUser']);

const createUser: boolean = useRoute().name === 'users.create';

const userData = ref({...props.user});
</script>

<template>
  <h2 class="form-title">{{ isEditRoute('users') ? 'Edit user' : 'Add user'}}</h2>

  <div class="form-wrapper">
    <form @submit.prevent="$emit('submitUser', userData)">
      <div>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" v-model="userData.firstName" required>
      </div>

      <div>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" v-model="userData.lastName" required>
      </div>

      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="userData.email" required>
      </div>

      <div>
        <label for="isAdmin">Is Admin:</label>
        <input type="checkbox" id="isAdmin" v-model="userData.isAdmin">
      </div>

      <div>
        <label for="phonenumber">Phone Number:</label>
        <input type="text" id="phonenumber" v-model="userData.phonenumber" required>
      </div>

      <div class="button-wrapper">
        <button>{{ isEditRoute('users') ? 'Edit user' : 'Sign up'}}</button>
      </div>
    </form>
  </div>
</template>

<style>
@import 'style/shared/form.css';
@import 'style/user/form.css';
</style>