import "./bootstrap";
// vue
import { createApp } from "vue";
// toastr
import "izitoast/dist/css/iziToast.min.css";
import iziToast from "izitoast";
import SweetAlert from "./sweetalert";
import i18n from "./languages";

const app = createApp({});

app.use(i18n);

app.use(SweetAlert);

iziToast.settings({
    position: "topRight",
});

app.config.globalProperties.$iziToast = iziToast;

// import admin component template
import AdminDashboard from "./admin/AdminDashboard.vue";
import AdminProfile from "./admin/profile/Profile.vue";
import AdminBusinesse from "./admin/businesse/BusinesseList.vue";
import AdminCreateBusinesse from "./admin/businesse/CreateBusinesse.vue";
import AdminEditBusinesse from "./admin/businesse/EditBusinesse.vue";
import AdminBusinesseType from "./admin/businesse-type/BusinesseType.vue";
import AdminPricingPlan from "./admin/pricing-plan/PricingPlan.vue";
import AdminPackage from "./admin/package/Package.vue";
import AdminTestimonial from "./admin/testimonial/TestimonialList.vue";

// import backend component template
import Dashboard from "./backend/Dashboard.vue";
import UserProfile from "./backend/user/Profile.vue";
import BackendSupplier from "./backend/supplier/Supplier.vue";
import BackendCustomer from "./backend/customer/Customer.vue";
import BackendCustomerGroup from "./backend/customer-group/Group.vue";
import BackendArea from "./backend/area/Area.vue";
import BackendAsset from "./backend/asset/Asset.vue";
import BackendAssetCategory from "./backend/asset-category/AssetCategory.vue";

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

app.mount("#app");
