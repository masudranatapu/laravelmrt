import './bootstrap'
// vue
import { createApp } from 'vue'
// javascript

// toastr
import 'izitoast/dist/css/iziToast.min.css'
import iziToast from 'izitoast'
import SweetAlert from './sweetalert'

const app = createApp({})

app.use(SweetAlert)

iziToast.settings({
    position: 'topRight'
})

app.config.globalProperties.$iziToast = iziToast

// import admin component template
import AdminDashboard from './components/admin/AdminDashboard.vue'
import AdminProfile from './components/admin/profile/Profile.vue'
import AdminBusinesse from './components/admin/businesse/BusinesseList.vue'
import AdminCreateBusinesse from './components/admin/businesse/CreateBusinesse.vue'
import AdminEditBusinesse from './components/admin/businesse/EditBusinesse.vue'

// import backend component template
import Dashboard from './components/backend/Dashboard.vue'
import UserProfile from './components/backend/user/Profile.vue'
import BackendCustomer from './components/backend/customer/Customer.vue'
import BackendCustomerGroup from './components/backend/customer-group/Group.vue'

// admin component
app.component('admin-dashboard', AdminDashboard)
app.component('admin-profile', AdminProfile)
app.component('admin-businesse', AdminBusinesse)
app.component('admin-businesse-create', AdminCreateBusinesse)
app.component('admin-businesse-edit', AdminEditBusinesse)

// backend component
app.component('backend-dashboard', Dashboard)
app.component('backend-profile', UserProfile)
app.component('backend-customer', BackendCustomer)
app.component('backend-customers-group', BackendCustomerGroup)

app.mount('#app')
