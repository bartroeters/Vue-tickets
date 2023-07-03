<script setup lang="ts">
import { postRequest } from 'services/http';
import { ref } from 'vue';
import { UserToRegister } from 'domains/users/types';
import { goToLoginPage, login } from '..';
import { goToRoute } from 'services/router';

const userToRegister = ref<UserToRegister>({
  id: 0,
  firstName: '',
  lastName: '',
  email: '',
  isAdmin: false,
  phonenumber: 0,
  password: '',
  repeatedPassword: ''
});

const registerUser = async () => {
  await postRequest(`register`, userToRegister.value);
  await login({email: userToRegister.value.email, password: userToRegister.value.password});
  goToRoute('tickets.overview');
};
</script>

<template>
    <h2 class="form-title">Register</h2>
  
    <div class="form-wrapper">
      <form @submit.prevent="registerUser">
        <div>
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" v-model="userToRegister.firstName">
        </div>
  
        <div>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" v-model="userToRegister.lastName">
        </div>
  
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="userToRegister.email">
        </div>
  
        <div>
          <label for="isAdmin">Is Admin:</label>
          <input type="checkbox" id="isAdmin" v-model="userToRegister.isAdmin">
        </div>
  
        <div>
          <label for="phonenumber">Phone Number:</label>
          <input type="text" id="phonenumber" v-model="userToRegister.phonenumber">
        </div>

        <div class="mb-2">
            <label for="email">Password:</label>
            <input
              v-model="userToRegister.password"
              type="password"
              name="password"
            
              />
        </div>

        <div class="mb-2">
            <label for="password">Repeat password:</label>
            <input
                v-model="userToRegister.repeatedPassword"
                type="password"
                name="repeatedPassword"
              
            />
        </div>
  
        <div class="button-wrapper">
          <button>Sign up</button>
        </div>
      </form>

      <!-- <form @submit.prevent="registerUser">
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
            <input
              v-model="newCredentials.password"
              type="password"
              name="password"
              required
              />
        </div>

        <div class="mb-2">
            <label for="password">Repeat password:</label>
            <input
                v-model="newCredentials.repeatedPassword"
                type="password"
                name="repeatedPassword"
                required
            />
        </div>
  
        <div class="button-wrapper">
          <button>Sign up</button>
        </div>
      </form> -->
    </div>
  </template>
  
  <style>
  @import 'style/shared/form.css';
  @import 'style/user/form.css';
  </style>
