declare module 'get-formatted-content' {
    import { Ref } from 'vue';
  
    export const showAllContent: Ref<Record<number, boolean>>;
    export function toggleContent(ticketId: number): void;
    export function getFormattedContent(content: string): string;
  }
  