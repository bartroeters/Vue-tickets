import Ticket from './types';
import { storeModuleFactory } from 'services/store';
import { createOverviewRoute, createCreateRoute, createEditRoute, createShowRoute } from 'services/router/factory';
import OverviewVue from './pages/Overview.vue';
import ShowVue from './pages/Show.vue';
import CreateVue from './pages/Create.vue';
import EditVue from './pages/Edit.vue';
import { categoryStore } from 'domains/categories';
import { userStore } from 'domains/users';
import { statusStore } from 'domains/statuses';
import { responseStore } from 'domains/responses';
import { Response as ResponseType } from 'domains/responses/types';

export const TICKET_DOMAIN_NAME = 'tickets';

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewVue),
    createShowRoute(TICKET_DOMAIN_NAME, ShowVue),
    createCreateRoute(TICKET_DOMAIN_NAME, CreateVue),
    createEditRoute(TICKET_DOMAIN_NAME, EditVue)
];

export const getSortedTickets = () => {
    return ticketStore.getters.all.value.sort((oldTicket, newTicket) => {
        const oldestTicket = new Date(oldTicket.createdAt).getTime();
        const newestTicket = new Date(newTicket.createdAt).getTime();
        return newestTicket - oldestTicket;
    });
};

export const getCategoryTitle = (categoryId: number) => {
    return categoryStore.getters.byId(categoryId).value?.title;
};

export const getUserFullName = (userId: number) => {
    const firstName = userStore.getters.byId(userId).value?.firstName;
    const lastName = userStore.getters.byId(userId).value?.lastName;
    return `${firstName} ${lastName}`;
};
  
export const getStatusTitle = (statusId: number) =>   {
    return statusStore.getters.byId(statusId).value?.title;
};
  
export const getResponseValue = (ticketId: number): ResponseType[] => {
    const responses = responseStore.getters.all.value;
    return responses.filter((response: ResponseType) => response.ticketId === ticketId)
                    .map((response: ResponseType) => Object.freeze(response));
};
