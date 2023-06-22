<script setup lang="ts">
import { PropType, ref } from 'vue';
import { Response as ResponseType } from '../types';
import Ticket from 'domains/tickets/types';
import { getLoggedInUser } from '../../auth';
import { ticketStore } from '../../tickets';
import { resizeTextarea } from 'components/form/resize-text-area';

const props = defineProps({
    response: { type: Object as PropType<ResponseType>},
    ticket: { type: Object as PropType<Ticket>}
});

console.log(props.ticket.id);

defineEmits(['submitResponse']);

// const ticketId = props.ticket?.id;

const responseData = ref({
    ...props.response,
    userId: getLoggedInUser.value.id,
    // ticketId: props.response?.ticketId,
    // ticketId: props.ticket?.id
});
</script>

<template>
    <div class="response-form-wrapper">
        <form @submit.prevent="$emit('submitResponse', responseData)">

            <!-- <input type="hidden" name="ticketId" :value="responseData.ticketId"> -->

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
