<script setup>
import {goToOverviewPage} from 'services/router';
import {login} from '../';
import {ref} from 'vue';
import { TICKET_DOMAIN_NAME } from '../../tickets';

const credentials = ref({});

const submit = async () => {
    await login(credentials.value);
    goToOverviewPage(TICKET_DOMAIN_NAME);
};
</script>

<template>
    <h1 class="form-title">Login</h1>

    <form class="form-wrapper" @submit.prevent="submit">
        <div class="mb-2">
            <input
                v-model="credentials.email"
                type="email"
                name="email"
                placeholder="Email address"
                class="form-input"
            />
        </div>
        
        <div class="mb-2">
            <input
                v-model="credentials.password"
                type="password"
                name="password"
                placeholder="Password"
                class="form-input"
            />
        </div>

        <div class="stay-logged-in-wrapper">
            <input id="remember" type="checkbox" name="remember" class="form-checkbox" />
            <label for="remember" class="form-label">&nbsp;Ingelogd blijven</label>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Login</button>
        </div>

        <div class="form-links">
            <router-link :to="{ name: 'forgotPassword' }" class="form-link">Wachtwoord vergeten</router-link>
            <router-link :to="{ name: 'register' }" class="form-link">Register</router-link>
        </div>
    </form>
</template>
  

<style scoped>
@import 'style/login-form.css';
</style>
