<script setup lang="ts">
import { TICKET_DOMAIN_NAME } from 'domains/tickets';
import { getCurrentRouteToken, goToOverviewPage } from 'services/router';
import { getRequest, postRequest } from 'services/http';
import { login } from '..';
import { ref } from 'vue';
import User from 'domains/users/types';

const newCredentials = ref({ password: '', repeatedPassword: '', phonenumber: '' });

const userToRegister = ref<User>({
  id: 0,
  firstName: '',
  lastName: '',
  email: '',
  isAdmin: false,
  phonenumber: 0,
  inviteToken: ''
});

const registerUser = async () => {
  await postRequest(`register`, newCredentials.value);
  await login({ email: userToRegister.value.email, password: newCredentials.value.password });
  goToOverviewPage(TICKET_DOMAIN_NAME);
};
</script>

<template>
    <h2 class="form-title">Register</h2>
  
    <div class="form-wrapper">
      <form @submit.prevent="registerUser">
        <div>
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" v-model="userToRegister.firstName" required>
        </div>
  
        <div>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" v-model="userToRegister.lastName" required>
        </div>
  
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="userToRegister.email" required>
        </div>
  
        <div>
          <label for="isAdmin">Is Admin:</label>
          <input type="checkbox" id="isAdmin" v-model="userToRegister.isAdmin">
        </div>
  
        <div>
          <label for="phonenumber">Phone Number:</label>
          <input type="text" id="phonenumber" v-model="userToRegister.phonenumber" required>
        </div>

        <div class="mb-2">
            <label for="email">Password:</label>
            <input v-model="newCredentials.password" type="password" class="form-control" name="password" />
        </div>

        <div class="mb-2">
            <label for="password">Repeat password:</label>
            <input
                v-model="newCredentials.repeatedPassword"
                type="password"
                class="form-control"
                name="repeatedPassword"
            />
        </div>
  
        <div class="button-wrapper">
          <button>Sign up</button>
        </div>
      </form>
    </div>
  </template>
  
  <style>
  @import 'style/shared/form.css';
  @import 'style/user/form.css';
  </style>
