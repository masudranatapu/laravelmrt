import "./bootstrap";
// vue
import { createApp } from "vue";
// toastr
import "izitoast/dist/css/iziToast.min.css";
import iziToast from "izitoast";
// sweetalert
import SweetAlert from "./sweetalert";
// language
import i18n from "./languages";
// Pagination
import { Bootstrap4Pagination } from "laravel-vue-pagination";

// multiselect
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

const app = createApp({});

app.use(i18n);

app.use(SweetAlert);

iziToast.settings({
    position: "topRight",
});

app.config.globalProperties.$iziToast = iziToast;

// globally Bootstrap Pagination
app.component("Pagination", Bootstrap4Pagination);
app.component("multiselect", Multiselect);

// import admin component template
import AdminDashboard from "./admin/AdminDashboard.vue";
import AdminProfile from "./admin/profile/Profile.vue";
import AdminBusinesse from "./admin/businesse/List.vue";
import AdminCreateBusinesse from "./admin/businesse/Create.vue";
import AdminEditBusinesse from "./admin/businesse/Update.vue";
import AdminBusinesseType from "./admin/businesse-type/List.vue";
import AdminPricingPlan from "./admin/pricing-plan/List.vue";
import AdminPackage from "./admin/package/List.vue";
import AdminTestimonial from "./admin/testimonial/List.vue";

// import backend component template
import Dashboard from "./backend/Dashboard.vue";
import UserProfile from "./backend/user/Profile.vue";
import BackendSupplier from "./backend/supplier/List.vue";
import BackendCustomer from "./backend/customer/List.vue";
import BackendCustomerGroup from "./backend/customer-group/List.vue";
import BackendArea from "./backend/area/List.vue";
import BackendAsset from "./backend/asset/List.vue";
import BackendAssetCategory from "./backend/asset-category/List.vue";
import BackendAccount from './backend/account/List.vue'
import BackendExpenseType from './backend/expenseType/List.vue'
import BackendExpense from './backend/expense/List.vue'
import BackendCategory from './backend/category/List.vue'

// admin component
app.component("admin-dashboard", AdminDashboard);
app.component("admin-profile", AdminProfile);
app.component("admin-businesse", AdminBusinesse);
app.component("admin-businesse-create", AdminCreateBusinesse);
app.component("admin-businesse-edit", AdminEditBusinesse);
app.component("admin-businesse-type", AdminBusinesseType);
app.component("admin-pricing-plan", AdminPricingPlan);
app.component("admin-package", AdminPackage);
app.component("admin-testimonial", AdminTestimonial);

// backend component
app.component("backend-dashboard", Dashboard);
app.component("backend-profile", UserProfile);
app.component("backend-supplier", BackendSupplier);
app.component("backend-customer", BackendCustomer);
app.component("backend-customers-group", BackendCustomerGroup);
app.component("backend-area", BackendArea);
app.component("backend-asset", BackendAsset);
app.component("backend-asset-category", BackendAssetCategory);
app.component('backend-account', BackendAccount)
app.component('backend-expense-type', BackendExpenseType)
app.component('backend-expense', BackendExpense)
app.component('backend-category', BackendCategory)

app.mount("#app");
