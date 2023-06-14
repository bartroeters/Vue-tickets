import '@/bootstrap';
import { routes } from './routes';
import { createApp } from 'vue';
import App from '@/App.vue';
import { addRoutes, useRouterInApp } from 'services/router';
import { checkIfLoggedIn, isLoggedIn } from './domains/auth';

const app = createApp(App);

addRoutes(routes);

try {
    await checkIfLoggedIn();
} catch (_) {
    // so we dont get stuck in an endless loop of refreshing and checking if logged in
} finally {
    useRouterInApp(app);
    app.mount('#app');
}