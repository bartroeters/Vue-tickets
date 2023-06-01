import { ref } from 'vue';

export const showAllContent = ref<Record<number, boolean>>({});

export const toggleContent = (ticketId: number): void => {
    showAllContent.value[ticketId] = !showAllContent.value[ticketId];
};

export function getFormattedContent(content: string) {
    const lines = content.split('\n');
    const truncatedContent = lines.slice(0, showAllContent.value ? undefined : 4).join('\n');
    const remainingLines = lines.length - 2;
    return truncatedContent + (remainingLines > 0 && !showAllContent.value ? `\n+ ${remainingLines} more line(s)` : '');
}
