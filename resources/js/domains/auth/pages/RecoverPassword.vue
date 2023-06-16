<script setup>
import {goToLoginPage} from '..';
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import BaseFormError from 'components/FormError.vue';

const email = ref('');

const sendEmailRecoverPassword = async () => {
    await postRequest('recover-password', {email: email.value});
    successToast('Password recovery email has been sent. Please check your inbox.');
    goToLoginPage();
};
</script>

<template>
    <form @submit.prevent="RecoverPassword">
        <h1>Forgot password</h1>
        
        <p>Please enter your email address below. You will receive instructions to reset your password.</p>

        <div class="mb-2">
            <label for="email">Email</label>
            <input v-model="email" type="email" name="email" placeholder="e-mailadres" />
            <BaseFormError name="email" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button class="m-1 btn btn-primary" @click="sendEmailRecoverPassword">Send</button>
            <router-link class="" :to="{name: 'Login'}">Go back</router-link>
        </div>
    </form>
</template>
