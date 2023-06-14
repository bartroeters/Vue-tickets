<script setup>
import {goToLoginPage} from '..';
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import BaseFormError from 'components/FormError.vue';

const email = ref('');

const sendEmailResetPassword = async () => {
    await postRequest('send-email-reset-password', {email: email.value});
    successToast('Email sent with a link to reset the password');
    goToLoginPage();
};
</script>

<template>
    <form @submit.prevent="RequestResetPassword">
        <h1>Forgot passowrd</h1>
        <p>Please enter your email address below. You will receive instructions to reset your password.</p>

        <div class="mb-2">
            <label for="email">Email</label>
            <input v-model="email" type="email" class="form-control" name="email" placeholder="e-mailadres" />
            <BaseFormError name="email" />
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button class="m-1 btn btn-primary" @click="sendEmailResetPassword">Send</button>
            <router-link class="" :to="{name: 'Login'}">Go back</router-link>
        </div>
    </form>
</template>
