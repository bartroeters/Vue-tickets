import Category from './types';
import { storeModuleFactory } from 'services/store';
import OverviewPage from './pages/Overview.vue';
import CreatePage from './pages/Create.vue';
import EditPage from './pages/Edit.vue';
import { createOverviewRoute, createEditRoute, createCreateRoute } from 'services/router/factory';
import Ticket from '../tickets/types';
import { ticketStore } from '../tickets';

export const CATEGORY_DOMAIN_NAME = 'categories';

export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);

export const categoryRoutes = [
    createOverviewRoute(CATEGORY_DOMAIN_NAME, OverviewPage),
    createCreateRoute(CATEGORY_DOMAIN_NAME, CreatePage),
    createEditRoute(CATEGORY_DOMAIN_NAME, EditPage)
];

export const getCategoryTicketCount = (category: Category) => {
    return ticketStore.getters.all.value.filter((ticket: Ticket) => ticket.categoryIds.includes(category.id)).length;
};

export const getSortedCategories = () => {
    return categoryStore.getters.all.value.sort((categoryA, categoryZ) =>
        categoryA.title.localeCompare(categoryZ.title)
    );
};
