import Status from './types';
import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import { createOverviewRoute } from 'services/router/factory';

export const STATUS_DOMAIN_NAME = 'statuses';

export const statusStore = storeModuleFactory<Status>(STATUS_DOMAIN_NAME);

export const statusRoutes = [
    createOverviewRoute(STATUS_DOMAIN_NAME, OverviewPage)
];