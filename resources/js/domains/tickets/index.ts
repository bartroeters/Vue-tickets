import Ticket from './types';
import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import { createOverviewRoute } from 'services/router/factory';

export const TICKET_DOMAIN_NAME = 'tickets';

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage)
];