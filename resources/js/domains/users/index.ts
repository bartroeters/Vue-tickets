import User from './types';
import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import { createOverviewRoute } from 'services/router/factory';

export const TICKET_DOMAIN_NAME = 'users';

export const userStore = storeModuleFactory<User>(TICKET_DOMAIN_NAME);

export const userRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage)
];