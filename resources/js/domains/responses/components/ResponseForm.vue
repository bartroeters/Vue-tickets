<script setup lang="ts">
import { PropType, onMounted, ref } from 'vue';
import { Response as ResponseType } from '../types';
import Ticket from 'domains/tickets/types';
import { getLoggedInUser } from '../../auth';
import { ticketStore } from '../../tickets';
import { resizeTextarea } from 'components/form/resize-text-area';

const props = defineProps({
    response: { type: Object as PropType<ResponseType>}
});

defineEmits(['submitResponse']);

console.log(props.response?.userId);

const responseData = ref({
    ...props.response,
    userId: getLoggedInUser.value.id
});
</script>

<template>
    <div class="response-form-wrapper">
        <form @submit.prevent="$emit('submitResponse', responseData)">

            <div>
                <label for="description">Response:</label>

                <textarea
                    name="content"
                    id="content"
                    @input="resizeTextarea"
                    v-model="responseData.content"
                    style="width: 600px; resize: vertical;"
                ></textarea>
            </div>

            <button>Submit</button>
        </form>
    </div>
</template>

<style scoped>
@import 'style/shared/form.css';

.response-form-wrapper {
    margin-top: 40px;
}
</style>
