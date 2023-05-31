import '@/bootstrap';
import { routes } from './routes';
import { createApp } from 'vue';
import App from '@/App.vue';
import { addRoutes, useRouterInApp } from 'services/router';

const app = createApp(App);
addRoutes(routes);
useRouterInApp(app);
app.mount('#app');