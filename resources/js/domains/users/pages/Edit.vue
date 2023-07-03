<script setup lang="ts">
import { getCurrentRouteId, goToRoute } from 'services/router';
import UserForm from '../components/UserForm.vue';
import { userStore } from '..';
import { User } from '../types';

const userId = getCurrentRouteId();
const user = userStore.getters.byId(userId);

const editUser = async (userData: User) => {
    await userStore.actions.update(userId, userData);
    goToRoute('users.overview');
};
</script>

<template>
    <user-form :user="user" @submitUser="editUser"/>
</template>
