import { Credentials } from './types';
import { TICKET_DOMAIN_NAME } from 'domains/tickets';
import User from 'domains/users/types';
import { computed, ref } from 'vue';
import { getRequest, postRequest } from 'services/http';
import { goToOverviewPage, goToRoute, registerBeforeRouteMiddleware } from 'services/router';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import RequestResetPassword from './pages/RequestResetPassword.vue';
import ResetPassword from './pages/ResetPassword.vue';

export const authRoutes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    {
        path: '/reset-password/:token/:email',
        name: 'resetPassword',
        component: ResetPassword,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    {
        path: '/forgot-password',
        name: 'forgotPassword',
        component: RequestResetPassword,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {auth: false, canSeeWhenLoggedIn: false},
    },
];

export const loggedInUser = ref<User | null>(null);

export const isLoggedIn = computed(() => loggedInUser.value !== null);
export const getLoggedInUser = computed(() => loggedInUser.value);

export const login = async (credentials: Credentials) => {
    const {data} = await postRequest('login', credentials);
    if (!data) return;
    loggedInUser.value = data.user;
};

export const logout = async () => {
    await getRequest('logout');
    loggedInUser.value = null;
    goToLoginPage();
};

export const me = async () => {
    const {data} = await getRequest('me');
    if (!data) return;
    loggedInUser.value = data.user;
};

export const checkIfLoggedIn = async () => {
    const {data} = await getRequest('me');
    loggedInUser.value = data.user;
};

export const goToLoginPage = () => goToRoute('Login', undefined);

registerBeforeRouteMiddleware(({meta}) => {
    if (!isLoggedIn.value && meta?.auth) {
        goToLoginPage();
        return true;
    }
    if (isLoggedIn.value && !meta?.canSeeWhenLoggedIn) {
        goToOverviewPage(TICKET_DOMAIN_NAME);
        return true;
    }
    return false;
});