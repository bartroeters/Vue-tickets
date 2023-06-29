import { storeModuleFactory } from 'services/store';
import { createCreateRoute, createEditRoute } from 'services/router/factory';
import { Response as ResponseType } from './types';
import CreatePage from './pages/Create.vue';
import EditPage from './pages/Edit.vue';

export const RESPONSE_DOMAIN_NAME = 'responses';

export const responseStore = storeModuleFactory<ResponseType>(RESPONSE_DOMAIN_NAME);

export const responseRoutes = [
  createCreateRoute(RESPONSE_DOMAIN_NAME, CreatePage),
  createEditRoute(RESPONSE_DOMAIN_NAME, EditPage)
];