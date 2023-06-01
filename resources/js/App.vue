<script setup lang="ts">
import TheNavigation from 'components/TheNavigation.vue';
</script>

<template>
    <div class="app-container">
        <TheNavigation />

        <div class="container">
            <div class="row mt-4">
                <div class="col-md-12">
                    <RouterView />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.app-container {
    position: relative;
    background-color: #202020;
    color: #fff;
    min-height: 100vh;
}

.container {
    padding: 20px;
}

.row {
    margin: 0;
}

.mt-4 {
    margin-top: 20px;
}
</style>
