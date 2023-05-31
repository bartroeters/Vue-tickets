export default interface Ticket {
    id: number
    user_id: number
    assignee_id: number
    status_id: number
    title: string
    content: string
    created_at: Date
    updated_at: Date
};