<script setup lang="ts">
import { PropType, getCurrentInstance, nextTick, reactive, ref } from 'vue';
import { Response as ResponseType } from '../types';
import { getLoggedInUser } from '../../auth';
import { resizeTextarea } from 'components/form/resize-text-area';
import { isEditRoute } from 'helpers/is-create-route';
import Ticket from '../../tickets/types';

const props = defineProps({
    response: { type: Object as PropType<ResponseType>},
    ticket: {type: Object as PropType<Ticket>}
});

defineEmits(['submitResponse']);

const state = reactive({
    isSubmitting: false
});

const instance = getCurrentInstance();

const handleFormSubmit = async () => {
    state.isSubmitting = true;
    await nextTick();

    await new Promise(resolve => setTimeout(resolve, 1000));

    instance.emit('submitResponse', responseData.value);

    state.isSubmitting = false;
};

const responseData = ref({
    ...props.response,
    userId: isEditRoute('responses') ? getLoggedInUser.value.id : props.response.userId
});
</script>

<template>
    <div class="response-form-wrapper">
        <form @submit.prevent="$emit('submitResponse', responseData)">
            <div>
                <label>{{ isEditRoute('responses') ? 'Edit response:' : 'Write a response:' }}</label>

                <textarea
                    name="content"
                    id="content"
                    @input="resizeTextarea"
                    v-model="responseData.content"
                    style="width: 600px; resize: vertical;"
                ></textarea>
            </div>

            <button 
                :disabled="state.isSubmitting"
                @click="handleFormSubmit"
                >
                {{ state.isSubmitting ? 'Submitting...' : 'Submit' }}
            </button>
        </form>
    </div>
</template>

<style scoped>
@import 'style/shared/form.css';

.response-form-wrapper {
    margin-top: 40px;
}
</style>
