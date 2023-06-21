<script setup>
import {goToLoginPage} from '..';
import {postRequest} from 'services/http';
import {ref} from 'vue';
import {successToast} from 'services/toast';
import BaseFormError from 'components/FormError.vue';

const email = ref('');

const sendEmailResetPassword = async () => {
    await postRequest('send-email-reset-password', {email: email.value});
    successToast('Password reset email has been sent. Please check your inbox.');
    goToLoginPage();
};
</script>

<template>
    <form class="form-wrapper" @submit.prevent="resetPassword">
        <h1 class="form-title">Forgot password</h1>
    
        <p class="form-description">
            Please enter your email address below. You will receive instructions to reset your password.
        </p>
    
        <div class="form-field">
            <label for="email" class="form-label">Email</label>
            <input v-model="email" type="email" name="email" placeholder="Email address" class="form-input" />
            <BaseFormError name="email" class="form-error" />
        </div>
    
        <div class="form-actions">
            <button @click="sendEmailResetPassword" class="btn-primary">Send</button>
            <router-link :to="{ name: 'Login' }" class="form-link">Go back</router-link>
        </div>
    </form>
</template>
  
<style scoped>
@import 'style/forgot-password-form.css';
</style>