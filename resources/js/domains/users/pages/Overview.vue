<script setup lang="ts">
import { userStore } from '..';
import UserList from '../components/UserList.vue';

const users = userStore.getters.all;
userStore.actions.getAll();
</script>

<template>
    <user-list :users="users"/>
</template>
