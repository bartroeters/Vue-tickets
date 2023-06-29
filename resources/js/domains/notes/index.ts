import { storeModuleFactory } from 'services/store';
import { createCreateRoute } from 'services/router/factory';
import { Note } from './types';
import CreatePage from './pages/Create.vue';

export const NOTE_DOMAIN_NAME = 'notes';

export const noteStore = storeModuleFactory<Note>(NOTE_DOMAIN_NAME);

export const noteRoutes = [
  createCreateRoute(NOTE_DOMAIN_NAME, CreatePage)
];
