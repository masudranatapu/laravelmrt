<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Category') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="add()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Category') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
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
                                    <input type="text" class="form-control" @keyup="loadData()"
                                        :placeholder="$t('Search')" v-model="quarry.keyword">
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
                                                    <input type="checkbox" class="custom-control-input" id="allGroup"
                                                        @click="allChecked()" v-model="all_checked">
                                                    <label for="allGroup" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">{{ $t('Category Name') }}</th>
                                            <th class="text-center">{{ $t('Status') }}</th>
                                            <th class="text-center">{{ $t('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category, index) in categories">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'category_' + category?.id" :value='category?.id'
                                                        v-model="checkedIds">
                                                    <label :for="'category_' + category?.id"
                                                        class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ category?.name }}</td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="category?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="category?.status === 'Active'"
                                                        @change="statusChange(category?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(category?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="edit(category?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        @click="deleteData(category?.id)" title="Delete">
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
        <Create @load-category="refresh" />
        <Update @load-category="refresh" :editData="editData" />
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
            categories: {},
            metaData: {},
            editData: {},
            quarry: {
                per_page: 10,
                keyword: '',
                status: '',
            },
            checkedIds: [],
            all_checked: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
    },
    methods: {
        loadData(page = 1) {
            axios.get(`/category-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.categories = response.data.data;
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
            axios.get(`/category/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#edit").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        refresh() {
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
                    axios.get(`/category-bulk-delete?ids=${id}`).then((response) => {
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
                    // this.$swal.fire('Your data is safe now');
                }
            });
        },
        clearLoadData() {
            this.quarry.per_page = 10;
            this.quarry.keyword = '';
            this.quarry.status = '';
            this.all_checked = false;
            this.checkedIds = [];
            this.loadData();
        },
        statusChange(id) {
            axios.get(`/category-status-change/${id}`).then((response) => {
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
            if (this.checkedIds.length === this.categories.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.categories.map(category => category.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Category Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>./Create.vue./Update.vue
