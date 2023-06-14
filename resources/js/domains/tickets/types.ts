export default interface Ticket {
  id: number;
  userId: number;
  assigneeId: number;
  statusId: number;
  title: string;
  content: string;
  createdAt: string;
  updatedAt: string;
  categoryIds: number[];
}
