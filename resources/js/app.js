import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import Dashboard from "./components/backend/Dashboard.vue";

app.component('backend-dashboard', Dashboard);

app.mount('#app');
