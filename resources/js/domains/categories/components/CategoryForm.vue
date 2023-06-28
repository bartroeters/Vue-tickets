<script setup lang="ts">
import { PropType, ref } from 'vue';
import Category from '../types';
import { resizeTextarea } from 'components/form/resize-text-area';
import { isCreateRoute } from 'helpers/is-create-route';

const props = defineProps({
    category: {type: Object as PropType<Category>}
});

defineEmits(['submitCategory']);

const categoryData = ref({
    ...props.category
});
</script>

<template>
    <div class="form-wrapper">
        <form @submit.prevent="$emit('submitResponse', categoryData)">
            <div>
                <label>{{ isCreateRoute('categories') ? 'Edit category:' : 'Write a category:' }}</label>

                <div>
                    <label for="title">Title:</label>

                    <input name="title" id="title" v-model="categoryData.title" />
                </div>
            </div>

            <!-- <button 
                :disabled="state.isSubmitting"
                @click="handleFormSubmit"
                >
                {{ state.isSubmitting ? 'Submitting...' : 'Submit' }}
            </button> -->

            <button>Submit</button>
        </form>
    </div>
</template>

<style>
/* @import 'style/category-form'; */
@import 'style/shared/form';
</style>