<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Expenses') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="add()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Expense') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-1">
                                    <select class="form-control" @change="loadData()" v-model="quarry.sort_order">
                                        <option value="asc">
                                            {{ $t('ASC') }}
                                        </option>
                                        <option value="desc">
                                            {{ $t('DESC') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" @change="loadData()" v-model="quarry.per_page">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                        <option value="999999999">All</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <multiselect @search-change="pullExpenseTypes"
                                        v-model="quarry.expense_type" open-direction="bottom"
                                        :options="expense_types" :multiple="false" :close-on-select="true"
                                        :taggable="false" :clear-on-select="false" :allow-empty="false" @select="loadData"
                                        :preserve-search="true" placeholder="Choose Expense Type"
                                        label="text" track-by="id" selectLabel="" deselectLabel="">
                                        <template slot="singleLabel" slot-scope="{ option }">
                                            <strong>{{ option.text }}{{ option.id}}</strong>
                                        </template>
                                    </multiselect>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control"  @change="loadData()" v-model="quarry.account_type" required >
                                        <option value="">{{ $t('All') }}</option>
                                        <option v-for="(account_type, index) in account_types" :value="account_type" :selected="quarry.account_type === account_type">
                                            {{ account_type }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" v-if="quarry.account_type">
                                    <select class="form-control" @change="loadData()" v-model="quarry.account_id" required >
                                        <option v-if="quarry.account_type == 'Cash'" :value="cash_account.id" :selected="quarry.account_id === cash_account.id">
                                            {{ cash_account.text }}
                                        </option>
                                        <option v-if="quarry.account_type == 'Mobile Banking'" v-for="(mobile_banking, index) in mobile_bankings" :value="mobile_banking.id" :selected="quarry.account_id === mobile_banking.id">
                                            {{ mobile_banking.text }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Start date"
                                            v-model="quarry.start_date" @change="loadData()">
                                        <span class="input-group-text bg-success">{{ $t('To') }}</span>
                                        <input type="date" class="form-control" placeholder="End Date"
                                            v-model="quarry.end_date" @change="loadData()">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadData()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearSearch()">
                                            {{ $t('Clear') }}
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $t('Action') }}
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;" @click="bulkDelete()">
                                                {{ $t('Bulk Delete') }}
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
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all" @click="allChecked()" v-model="all_checked">
                                                    <label for="checkbox-all" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th>{{ $t('Date') }}</th>
                                            <th class="text-center">{{ $t('User') }}</th>
                                            <th class="text-center">{{ $t('Type') }}</th>
                                            <th class="text-center">{{ $t('Amount') }}</th>
                                            <th class="text-center">{{ $t('Payment Type') }}</th>
                                            <th class="text-center">{{ $t('Account') }}</th>
                                            <th class="text-center">{{ $t('Note') }}</th>
                                            <th class="text-center">
                                                {{ $t('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(expense, index) in expenses">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :value="expense?.id"
                                                        v-model="checkedIds" :id="'checked_' + expense?.id">
                                                    <label :for="'checked_' + expense?.id"
                                                        class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ expense?.date }}</td>
                                            <td class="text-center">{{ expense?.user.name }}</td>
                                            <td class="text-center">{{ expense?.type.text }}</td>
                                            <td class="text-center">{{ expense?.amount }}</td>
                                            <td class="text-center">{{ expense?.pay_by }}</td>
                                            <td class="text-center">{{ expense?.account.mobile_bank_name ??  expense?.account.type }}</td>
                                            <td class="text-center">{{ expense?.note }}</td>
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
                                                            @click="edit(expense?.id)">
                                                            <i class="fas fa-pen"></i>
                                                            {{ $t('Edit') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteData(expense?.id)">
                                                            <i class="fa fa-times"></i>
                                                            {{ $t('Delete') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="mr-auto">
                                    <span>
                                        Showing {{ metaData.from }} to {{ metaData.to }} of {{ metaData.total }} entries
                                    </span>
                                </div>
                                <div>
                                    <Bootstrap4Pagination :data="metaData" @pagination-change-page="loadData"
                                        :limit="5">
                                    </Bootstrap4Pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Create @load-data="refreshData" />
        <Update @load-data="refreshData" :editData="editData" />
    </div>
</template>

<script>
import Create from './Create.vue'
import Update from './Update.vue'
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
export default {
    components: {
        Create,
        Update,
        Bootstrap4Pagination,
    },
    props: [],
    data: function () {
        return {
            quarry: {
                per_page: 10,
                sort_order: 'asc',
                account_type: '',
                account_id: '',
                expense_type: null,
            },
            expenses: [],
            editData: {},
            metaData: {},
            checkedIds: [],
            all_checked: false,
            account_types: {},
            expense_types: [],
            mobile_bankings: [],
            cash_account: {},
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
        this.pullExpenseTypes();
        this.pullAccounts();
    },
    methods: {
        pullExpenseTypes: function (text = null) {
            axios.get(`/ajax/expense-type-pagination?text=${text ?? ''}`)
            .then((response) => {
                this.expense_types = response.data.data;
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
        pullAccounts: function (text = null) {
            axios.get(`/ajax/account-pagination?text=${text ?? ''}`)
            .then((response) => {
                this.mobile_bankings = response.data.data.mobile_bankings;
                this.cash_account = response.data.data.cash_account;
            });
        },
        loadData(page = 1) {
            axios.get(`/expense-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.expenses = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        add() {
            $("#create").modal('show');
        },
        refreshData() {
            this.loadData();
        },
        edit(id) {
            axios.get(`/expense/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#edit").modal('show');
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
                    axios.get(`/expense-bulk-delete?ids=${id}`).then((response) => {
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
        clearSearch() {
            this.quarry.per_page = 10;
            this.quarry.sort_order = 'asc';
            this.quarry.expense_type = '';
            this.quarry.account_id = '';
            this.quarry.account_type = '';
            this.quarry.start_date = '';
            this.quarry.end_date = '';
            this.all_checked = false;
            this.checkedIds = [];
            this.loadData();
        },
        allChecked() {
            if (this.checkedIds.length === this.expenses.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.expenses.map(expense => expense.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Expense Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>
