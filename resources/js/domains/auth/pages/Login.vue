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
    <h1>Manos</h1>
    <form @submit.prevent="submit">
        <div class="mb-2">
            <input
                v-model="credentials.email"
                type="email"
                class="form-control"
                name="email"
                placeholder="Emailadress"
            />
        </div>
        <div class="mb-2">
            <input
                v-model="credentials.password"
                type="password"
                class="form-control"
                name="password"
                placeholder="Password"
            />
        </div>
        <div class="mb-3">
            <input id="remember" type="checkbox" name="remember" />
            <label for="remember">Ingelogd blijven</label>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Login</button>
        </div>
        <router-link :to="{name: 'forgotPassword'}">Wachtwoord vergeten</router-link>
    </form>
</template>
