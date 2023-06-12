import User from './types';
import { storeModuleFactory } from 'services/store';
import { createOverviewRoute, createShowRoute } from 'services/router/factory';
import OverviewVue from './pages/Overview.vue';
import ShowVue from './pages/Show.vue';

export const USER_DOMAIN_NAME = 'users';

export const userStore = storeModuleFactory<User>(USER_DOMAIN_NAME);

export const userRoutes = [
    createOverviewRoute(USER_DOMAIN_NAME, OverviewVue),
    createShowRoute(USER_DOMAIN_NAME, ShowVue)
];

export const getUserFullName = (userId: number) => {
    const firstName = userStore.getters.byId(userId).value?.firstName;
    const lastName = userStore.getters.byId(userId).value?.lastName;
    return `${firstName} ${lastName}`;
};
