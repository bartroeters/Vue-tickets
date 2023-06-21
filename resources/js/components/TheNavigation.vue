<script setup lang="ts">
import { isLoggedIn, logout } from '../domains/auth';
</script>

<template class="navigation-bar">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div>
                <router-link
                    :to="{name: 'tickets.overview'}"
                    class="header"
                    >
                    Tickets
                </router-link>
            </div>

            <button
                v-if="isLoggedIn"
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon">
                    <span>menu</span>
                </span>
            </button>

            <div
                v-if="isLoggedIn"
                class="collapse navbar-collapse menu"
                id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link
                            :to="{name: 'tickets.overview'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            Ticket Overview
                        </router-link>
                    </li>

                    <li v-if="!isLoggedIn" class="nav-item">
                        <router-link
                            :to="{name: 'Login'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            Login
                        </router-link>
                    </li>

                    <li v-if="isLoggedIn" class="nav-item">
                        <a  
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            <button @click="logout" class="logout">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
@import 'style/the-navigation.css';
</style>
