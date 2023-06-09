import Ticket from './types';
import { storeModuleFactory } from 'services/store';
import { createOverviewRoute, createCreateRoute, createEditRoute, createShowRoute } from 'services/router/factory';
import OverviewVue from './pages/Overview.vue';
import ShowVue from './pages/Show.vue';
import CreateVue from './pages/Create.vue';
import EditVue from './pages/Edit.vue';
import { categoryStore } from '../categories';
import { userStore } from '../users';
import { statusStore } from '../statuses';
import { responseStore } from '../responses';
import { Response as ResponseType } from 'domains/responses/types';

export const TICKET_DOMAIN_NAME = 'tickets';

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewVue),
    createShowRoute(TICKET_DOMAIN_NAME, ShowVue),
    createCreateRoute(TICKET_DOMAIN_NAME, CreateVue),
    createEditRoute(TICKET_DOMAIN_NAME, EditVue)
];

export const getCategoryTitle = (categoryId: number) => {
    return categoryStore.getters.byId(categoryId).value?.title;
};

export const getUserFullName = (userId: number) => {
    const firstName = userStore.getters.byId(userId).value?.first_name;
    const lastName = userStore.getters.byId(userId).value?.last_name;
    return `${firstName} ${lastName}`;
};

export const getStatusTitle = (statusId: number) =>   {
    const title = statusStore.getters.byId(statusId).value?.title;
    console.log(title)
    return title;
};
  
export const getResponseValue = (ticketId: number): ResponseType[] => {
    const responses = responseStore.getters.all.value;
    return responses.filter((response: ResponseType) => response.ticket_id === ticketId)
                    .map((response: ResponseType) => Object.freeze(response));
};
