export const resizeTextarea = (event: Event) => {
    const textarea = event.target as HTMLTextAreaElement;
    textarea.style.height = '';
    textarea.style.height = `${textarea.scrollHeight + 32}px`; // Increase height by 2 lines
};