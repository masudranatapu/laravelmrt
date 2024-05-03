<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Business Type') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addBusinessType()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Business Type') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.admin_id" @change="loadData()">
                                        <option value="">{{ $t('All') }}</option>
                                        <option v-for="(admin, index) in adminUsers" :value="admin.id" :key="index">
                                            {{ admin.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.status" @change="loadData()">
                                        <option value="">{{ $t('All') }}</option>
                                        <option value="Active">{{ $t('Active') }}</option>
                                        <option value="Inactive">{{ $t('Inactive') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" :placeholder="$t('Search')"
                                        v-model="quarry.keyword" @change="loadData()">
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
                                                    <input type="checkbox" @click="allChecked()" v-model="all_checked"
                                                        class="custom-control-input" id="allGroup">
                                                    <label for="allGroup" class="custom-control-label">
                                                        {{ $t(' SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">{{ $t('Business Type Name') }}</th>
                                            <th class="text-center">{{ $t('Status') }}</th>
                                            <th class="text-center">{{ $t('Created By') }}</th>
                                            <th class="text-center">{{ $t('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="( busi_type, index ) in businessTypes ">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'busiType_' + busi_type?.id" :value='busi_type?.id'
                                                        v-model="checkedIds">
                                                    <label :for="'busiType_' + busi_type?.id"
                                                        class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1
                                                        }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ busi_type?.business_type_name }}</td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="busi_type?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="busi_type?.status === 'Active'"
                                                        @change="statusChange(busi_type?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(busi_type?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                {{ busi_type?.created_by }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editInfo(busi_type?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteData(busi_type?.id)">
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
                                        Showing {{ metaData.from }} to {{ metaData.to }} of {{ metaData.total }}
                                        entries
                                    </span>
                                </div>
                                <div>
                                    <Pagination :data="metaData" @pagination-change-page="loadData" :limit="5">
                                    </Pagination>
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
export default {
    components: {
        Create,
        Update
    },
    data: function () {
        return {
            businessTypes: {},
            editData: {},
            adminUsers: {},
            quarry: {
                par_page: 10,
                keyword: '',
                admin_id: '',
                status: '',
            },
            metaData: {},
            checkedIds: [],
            all_checked: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
        this.loadAdminUsers();
    },
    methods: {
        loadData(page = 1) {
            axios.get(`/admin/business-type-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.businessTypes = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        loadAdminUsers() {
            axios.get("/admin/load-admin/users").then((response) => {
                this.adminUsers = response.data;
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t(`Fetching data has error. Please try again.`),
                    });
                }
            });
        },
        addBusinessType() {
            $("#createNewData").modal('show');
        },
        editInfo(id) {
            axios.get(`/admin/business-type/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#updateInfoData").modal('show');
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t(`Fetching data has error. Please try again.`),
                    });
                }
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
                    axios.get(`/admin/business-type-bulk-delete?ids=${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: this.$t('Success'),
                                message: this.$t(response.data.message),
                            });
                            this.loadData();

                            this.checkedIds = [];
                            this.all_checked = false;
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
                        message: 'Your data is safe now :)',
                    });
                }
            });
        },
        clearSearch() {
            this.quarry.par_page = 10;
            this.quarry.keyword = '';
            this.quarry.status = '';
            this.quarry.admin_id = '';
            this.loadData();
        },
        statusChange(id) {
            axios.get(`/admin/business-type/status/change/${id}`).then((response) => {
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
            if (this.checkedIds.length === this.businessTypes.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.businessTypes.map(businessType => businessType.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Business Type Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>
