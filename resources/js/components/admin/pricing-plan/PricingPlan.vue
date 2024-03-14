<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pricing Plan</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addPricingPlan()">
                                        <i class="fa fa-plus"></i>
                                        Add New Pricing Plan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.admin_id" @change="loadPricingPlan()">
                                        <option value="">All</option>
                                        <option v-for="(admin, index) in adminUsers" :value="admin.id" :key="index">
                                            {{ admin.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.type" @change="loadPricingPlan()">
                                        <option value="">All</option>
                                        <option value="Amount">Amount</option>
                                        <option value="Percentage">Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadPricingPlan()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearLoadPricingPlan()">
                                            Clear
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" class="custom-control-input" id="allGroup">
                                                    <label for="allGroup" class="custom-control-label">
                                                        SL No
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">Month</th>
                                            <th class="text-center">Discount Type</th>
                                            <th class="text-center">Value</th>
                                            <th class="text-center">Created By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(plans, index ) in  pricingPlans">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'plans_' + plans?.id" :value='plans?.id'>
                                                    <label :for="'plans_' + plans?.id" class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ plans?.month }} Month
                                            </td>
                                            <td class="text-center">
                                                {{ plans?.discount_type }}
                                            </td>
                                            <td class="text-center">
                                                {{ plans?.discount_value }}
                                            </td>
                                            <td class="text-center">
                                                {{ plans?.created_by }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editPricingPlan(plans?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deletePricingPlan(plans?.id)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <CreatePricingPlan @load-pricing-plan="refreshPricingPlan" />
        <UpdatePricingPlan @load-pricing-plan="refreshPricingPlan" :pricingPlansEdit="updatePricingPlan" />
    </div>
</template>

<script>
import CreatePricingPlan from './CreatePricingPlan.vue'
import UpdatePricingPlan from './UpdatePricingPlan.vue'
export default {
    components: {
        CreatePricingPlan,
        UpdatePricingPlan
    },
    data: function () {
        return {
            pricingPlans: {},
            updatePricingPlan: {},
            adminUsers: {},
            quarry: {
                parpage: 20,
                admin_id: '',
                type: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadPricingPlan();
        this.loadAdminUsers();
    },
    methods: {
        loadPricingPlan() {
            axios.get("/admin/pricing-plans/list", { params: this.quarry }).then((response) => {
                this.pricingPlans = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        loadAdminUsers() {
            axios.get("/admin/load-admin/users").then((response) => {
                this.adminUsers = response.data;
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: 'Error',
                        message: `Error fetching data for ${error}`,
                    });
                }
            });
        },
        addPricingPlan() {
            $("#createNewPricingPlan").modal('show');
        },
        editPricingPlan(id) {
            axios.get(`/admin/pricing-plans/edit/${id}`).then((response) => {
                this.updatePricingPlan = response.data.data;
                $("#editPricingPlan").modal('show');
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: 'Error',
                        message: `Error fetching data for ${error}`,
                    });
                }
            });
        },
        refreshPricingPlan() {
            this.loadPricingPlan();
        },
        deletePricingPlan(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/admin/pricing-plans/delete/${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadPricingPlan();
                        } else {
                            this.$iziToast.error({
                                title: 'Error',
                                message: response.data.message,
                            });
                        }
                    }).catch((error) => {
                        if (error) {
                            let errors = error.response.data.errors;
                            Object.keys(errors).forEach((key) => {
                                const value = errors[key];
                                this.$iziToast.error({
                                    title: 'Error',
                                    message: `${value}`,
                                });
                            });
                        } else {
                            this.$iziToast.error({
                                title: 'Error',
                                message: 'An error occurred while processing your request.',
                            });
                        }
                    });
                } else {
                    this.$iziToast.info({
                        title: 'Cancelled',
                        message: 'Your data is safe now :)',
                    });
                    // this.$swal.fire('Your data is safe now :)');
                }
            });
        },
        clearLoadPricingPlan() {
            this.quarry.parpage = 20;
            this.quarry.type = '';
            this.quarry.admin_id = '';
            this.loadPricingPlan();
        },
    },
}
</script>

<style lang="scss" scoped></style>
