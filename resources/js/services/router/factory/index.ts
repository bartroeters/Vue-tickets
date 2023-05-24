import {RouteComponent} from 'vue-router';

export const CREATE_PAGE_NAME = '.create';
export const EDIT_PAGE_NAME = '.edit';
export const OVERVIEW_PAGE_NAME = '.overview';
export const SHOW_PAGE_NAME = '.show';

export const createShowRoute = (module: string, component: RouteComponent) => ({
    path: `/${module}/:id`,
    name: module + SHOW_PAGE_NAME,
    component
});

export const createCreateRoute = (module: string, component: RouteComponent) => ({
    path: `/${module}/create`,
    name: module + CREATE_PAGE_NAME,
    component
});

export const createOverviewRoute = (module: string, component: RouteComponent) => ({
    path: `/${module}`,
    name: module + OVERVIEW_PAGE_NAME,
    component
});

export const createEditRoute = (module: string, component: RouteComponent) => ({
    path: `/${module}/:id/edit`,
    name: module + EDIT_PAGE_NAME,
    component
});