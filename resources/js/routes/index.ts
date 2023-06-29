import { ticketRoutes } from 'domains/tickets';
import { categoryRoutes } from 'domains/categories';
import { userRoutes } from 'domains/users';
import { responseRoutes } from 'domains/responses';
import { statusRoutes } from 'domains/statuses';
import { authRoutes } from 'domains/auth';
import { noteRoutes } from '../domains/notes';

export const routes = [
    {
        path: '/',
        redirect: '/tickets'
      },
    ...ticketRoutes,
    ...categoryRoutes,
    ...userRoutes,
    ...noteRoutes,
    ...responseRoutes,
    ...statusRoutes,
    ...authRoutes
];