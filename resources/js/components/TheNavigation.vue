<template>
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

            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link
                            :to="{name: 'tickets.overview'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            tickets/pages/Overview.vue
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{name: 'users.overview'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            users/pages/Overview.vue
                        </router-link>
                    </li>

                    <!-- <li class="nav-item">
                        <router-link
                            :to="{name: 'books.create'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            Add book
                        </router-link>
                    </li> -->

                    <!-- <li class="nav-item">
                        <router-link
                            :to="{name: 'authors.create'}"
                            class="nav-link active router-link-exact-active"
                            active-class="active-link"
                            aria-current="page"
                            >
                            Add author
                        </router-link>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
@import 'style/the-navigation.css';
</style>
