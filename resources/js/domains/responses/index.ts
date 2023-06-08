// import Response from './types';
// import { storeModuleFactory } from 'services/store';
// import OverviewPage from './pages/Overview.vue';
// import { createOverviewRoute } from 'services/router/factory';

// export const RESPONSE_DOMAIN_NAME = 'responses';

// export const responseStore = storeModuleFactory<Response>(RESPONSE_DOMAIN_NAME);

// export const responseRoutes = [
//     createOverviewRoute(RESPONSE_DOMAIN_NAME, OverviewPage)
// ];

import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import { createOverviewRoute } from 'services/router/factory';
import { Response as ResponseType } from './types'; // Rename the imported type

export const RESPONSE_DOMAIN_NAME = 'responses';

export const responseStore = storeModuleFactory<ResponseType>(RESPONSE_DOMAIN_NAME);

export const responseRoutes = [
  createOverviewRoute(RESPONSE_DOMAIN_NAME, OverviewPage)
];