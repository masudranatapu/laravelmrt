<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Expense Type') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="add()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Expense Type') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
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
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
                                    <select class="form-control" @change="loadData()" v-model="quarry.status">
                                        <option value="">{{ $t('All') }}</option>
                                        <option value="Active">{{ $t('Active') }}</option>
                                        <option value="Inactive">{{ $t('Inactive') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" :placeholder="$t('Search')"
                                        v-model="quarry.keyword" @keyup="loadData()">
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadData()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearLoadData()">
                                            {{ $t('Clear') }}
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $t('Action') }}
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;" @click="bulkDelete()">
                                                {{ $t('Delete') }}
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
                                                    <input type="checkbox" class="custom-control-input"
                                                        @click="allChecked()" v-model="all_checked" id="allGroup">
                                                    <label for="allGroup" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Name') }}
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
                                        <tr v-for="(expenseType, index) in expenseTypes">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'type_' + expenseType?.id" :value='expenseType?.id' v-model="checkedIds">
                                                    <label :for="'type_' + expenseType?.id" class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ expenseType?.expense_type_name }}
                                            </td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="expenseType?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input" :checked="expenseType?.status === 'Active'"
                                                        @change="statusChange(expenseType?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(expenseType?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" :title="$t('Edit')"
                                                        @click="edit(expenseType?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        @click="deleteData(expenseType?.id)" :title="$t('Delete')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                    <span>
                                        Showing {{ metaData.from }} to {{ metaData.to }} of {{ metaData.total }} entries
                                    </span>
                                </div>
                                <div class="p-2">
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
        <Create @load-expense-types="refreshData" />
        <Update @load-expense-types="refreshData" :editData="editData" />
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
    data: function () {
        return {
            expenseTypes: [],
            editData: {},
            metaData: {},
            checkedIds: [],
            all_checked: false,
            quarry: {
                per_page: 10,
                sort_order: 'asc',
                keyword: '',
                status: '',
            },
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
    },
    methods: {
        loadData(page = 1) {
            axios.get(`/expense-types-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.expenseTypes = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        add() {
            $("#create").modal('show');
        },
        edit(id) {
            axios.get(`/expense-types/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#edit").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        refreshData() {
            this.loadData();
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
                    axios.get(`/expense-types-bulk-delete?ids=${id}`).then((response) => {
                        this.isButtonDisabled = false;
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
        clearLoadData() {
            this.quarry.per_page = 10;
            this.quarry.sort_order = 'asc';
            this.quarry.keyword = '';
            this.quarry.status = '';
            this.all_checked = false;
            this.checkedIds = [];
            this.loadData();
        },
        statusChange(id) {
            axios.get(`/expense-types-status-change/${id}`).then((response) => {
                this.isButtonDisabled = false;
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
        },

        allChecked() {
            if (this.checkedIds.length === this.types.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.types.map(type => type.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Expense Type Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>./Create.vue./Update.vue
