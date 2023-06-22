import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import { createOverviewRoute, createCreateRoute } from 'services/router/factory';
import { Response as ResponseType } from './types';
import CreatePage from './pages/Create.vue';

export const RESPONSE_DOMAIN_NAME = 'responses';

export const responseStore = storeModuleFactory<ResponseType>(RESPONSE_DOMAIN_NAME);

export const responseRoutes = [
  createOverviewRoute(RESPONSE_DOMAIN_NAME, OverviewPage),
  createCreateRoute(RESPONSE_DOMAIN_NAME, CreatePage),
];