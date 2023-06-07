import Ticket from './types';
import { storeModuleFactory } from 'services/store';
import { createOverviewRoute, createCreateRoute, createEditRoute, createShowRoute } from 'services/router/factory';
import OverviewVue from './pages/Overview.vue';
import ShowVue from './pages/Show.vue';
import CreateVue from './pages/Create.vue';
import EditVue from './pages/Edit.vue';

export const TICKET_DOMAIN_NAME = 'tickets';

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewVue),
    createShowRoute(TICKET_DOMAIN_NAME, ShowVue),
    createCreateRoute(TICKET_DOMAIN_NAME, CreateVue),
    createEditRoute(TICKET_DOMAIN_NAME, EditVue)
];