import { ref } from 'vue';

export const showAllContent = ref<Record<number, boolean>>({});

export const toggleContent = (ticketId: number): void => {
    showAllContent.value[ticketId] = !showAllContent.value[ticketId];
};

export function getFormattedContent(content: string, ticketId: number) {
    return content.split('\n').slice(0, showAllContent.value[ticketId] ? undefined : 10).join('\n');
}
