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
  password: '',
  isAdmin: false,
  phonenumber: 0,
  inviteToken: ''
});

const getUserToRegister = async (token: string) => {
  const { data } = await getRequest(`get-user-to-register/${token}`);
  if (!data) return;
  userToRegister.value = data;
};

const submit = async () => {
  await postRequest(`register/${userToRegister.value.inviteToken}`, newCredentials.value);
  await login({ email: userToRegister.value.email, password: newCredentials.value.password });
  goToOverviewPage(TICKET_DOMAIN_NAME);
};

getUserToRegister(getCurrentRouteToken());
</script>

<template>
    <h1>Register</h1>
    <form @submit.prevent="submit">
        <div class="mb-2">
            <label for="email">First name:</label>
            <input v-model="userToRegister.firstName" type="text" class="form-control" name="firstName" disabled />
        </div>
        <div class="mb-2">
            <label for="email">Last name:</label>
            <input v-model="userToRegister.lastName" type="text" class="form-control" name="lastName" disabled />
        </div>
        <div class="mb-2">
            <label for="email">Email:</label>
            <input v-model="userToRegister.email" type="text" class="form-control" name="email" disabled />
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
        <div class="pt-3">
            <button>Register</button>
        </div>
    </form>
</template>
