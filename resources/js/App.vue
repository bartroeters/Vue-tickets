<script setup lang="ts">
import TheNavigation from 'components/TheNavigation.vue';
</script>

<template>
    <TheNavigation />
    
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <RouterView />
            </div>
        </div>
    </div>
</template>