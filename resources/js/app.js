import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});
// import admin template
import AdminDashboard from "./components/admin/AdminDashboard.vue";
import Dashboard from "./components/backend/Dashboard.vue";
import UserProfile from "./components/Backend/user/Profile.vue";

// admin component
app.component('admin-dashboard', AdminDashboard);

// backend component
app.component('backend-dashboard', Dashboard);
app.component('backend-profile', UserProfile);

app.mount('#app');
