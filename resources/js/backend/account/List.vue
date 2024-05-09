<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Accounts') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addNewData()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add Account') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h5>{{ $t('Mobile Bankings') }}</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all" @click="allChecked()" v-model="all_checked">
                                                    <label for="checkbox-all" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                {{ $t('Name') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Phone') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Service Charge') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Status') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(mobile_banking, index) in mobile_bankings">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :value="mobile_banking?.id"
                                                        v-model="checkedIds" :id="'checked_' + mobile_banking?.id">
                                                    <label :for="'checked_' + mobile_banking?.id"
                                                        class="custom-control-label">
                                                        {{ index+1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <img :alt='mobile_banking?.name' :src='mobile_banking?.image' class="rounded-circle"
                                                    width="35" data-toggle="tooltip">
                                                {{ mobile_banking?.mobile_bank_name }}
                                            </td>
                                            <td class="text-center">
                                                <a :href='"tel:" + mobile_banking?.phone'>
                                                    {{ mobile_banking?.mobile_number }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{ mobile_banking?.pm_charge }} %
                                            </td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="mobile_banking?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="mobile_banking?.status === 'Active'"
                                                        @change="statusChange(mobile_banking?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(mobile_banking?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ $t('Action') }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="view(mobile_banking?.id)">
                                                            <i class="fa fa-eye"></i>
                                                            {{ $t('View') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="edit(mobile_banking?.id)">
                                                            <i class="fas fa-pen"></i>
                                                            {{ $t('Edit') }}
                                                        </a>
                                                        <!-- <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteData(mobile_banking?.id)">
                                                            <i class="fa fa-times"></i>
                                                            {{ $t('Delete') }}
                                                        </a> -->
                                                    </div>
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
        <Create @load-data="refreshData" :account_types="account_types" :mobile_banking_names="mobile_banking_names" />
        <Update @load-data="refreshData" :account_types="account_types" :mobile_banking_names="mobile_banking_names" :editData="editData" />
        <View :viewData="viewData" />
    </div>
</template>

<script>
import Create from './Create.vue'
import Update from './Update.vue'
import View from './View.vue'
export default {
    components: {
        Create,
        Update,
        View,
    },
    props: [],
    data: function () {
        return {
            mobile_bankings: [],
            cash_account: {},
            editData: {},
            viewData: {},
            checkedIds: [],
            all_checked: false,
            account_types: {},
            account_types: {},
            mobile_banking_names: {},
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
        this.loadAccountTypes();
        this.loadMobileBankingNames();
    },
    methods: {
        loadData() {
            axios.get(`/account-list`, { params: this.quarry }).then((response) => {
                this.mobile_bankings = response.data.data.mobile_bankings;
                this.cash_account = response.data.data.cash_account;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        loadAccountTypes() {
            axios.get(`/load-account-types`).then((response) => {
                this.account_types = response.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        loadMobileBankingNames() {
            axios.get(`/load-mobile-banking-names`).then((response) => {
                this.mobile_banking_names = response.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        addNewData() {
            $("#create").modal('show');
        },
        refreshData() {
            this.loadData();
        },
        edit(id) {
            axios.get(`/account/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#edit").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        statusChange(id) {
            axios.get(`/account-status-change/${id}`).then((response) => {
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.loadData();
                } else {
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t(response.data.message),
                    });
                }
            }).catch((error) => {

                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });

            });
        },
        view(id) {
            axios.get(`/account/${id}`).then((response) => {
                if (response.data.data) {
                    this.viewData = response.data.data;
                    $("#view").modal('show');
                }
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });

            });
        },
        deleteData(id) {
            this.$swal.fire({
                title: this.$t('Are you sure?'),
                text: this.$t('You won\'t be able to revert this!'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: this.$t('Yes, Delete it!'),
                cancelButtonText: this.$t('No, Cancel'),
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/account-bulk-delete?ids=${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: this.$t('Success'),
                                message: this.$t(response.data.message),
                            });
                            this.all_checked = false;
                            this.checkedIds = [];
                            this.loadData();
                        } else {
                            this.$iziToast.error({
                                title: this.$t('Error'),
                                message: this.$t(response.data.message),
                            });
                        }
                    }).catch((error) => {
                        if (error) {
                            let errors = error.response.data.errors;
                            Object.keys(errors).forEach((key) => {
                                const value = errors[key];
                                this.$iziToast.error({
                                    title: this.$t('Error'),
                                    message: `${value}`,
                                });
                            });
                        } else {
                            this.$iziToast.error({
                                title: this.$t('Error'),
                                message: this.$t('An error occurred while processing your request.'),
                            });
                        }
                    });
                } else {
                    this.$iziToast.info({
                        title: 'Cancelled',
                        message: 'Your data is safe now',
                    });
                }
            });
        },
    },
}
</script>

<style lang="scss" scoped></style>
