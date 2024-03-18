<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Business Type</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addBusinessType()">
                                        <i class="fa fa-plus"></i>
                                        Add New Business Type
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.admin_id">
                                        <option value="">All</option>
                                        <option v-for="(admin, index) in adminUsers" :value="admin.id" :key="index">
                                            {{ admin.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.status">
                                        <option value="">All</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" placeholder="Searching"
                                        v-model="quarry.keyword">
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadBusinessType()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearLoadBusinessType()">
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
                                            <th class="text-center">Business Type Name</th>
                                            <th class="text-center">Business Options</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="( busi_type, index ) in  businessTypes ">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'busiType_' + busi_type?.id" :value='busi_type?.id'>
                                                    <label :for="'busiType_' + busi_type?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ busi_type?.business_type_name }}</td>
                                            <td class="text-center">
                                                <p v-for=" key  in  busi_type?.access " :key="key">
                                                    <b class="text-success">
                                                        {{ businessAccessOptions[key] }}
                                                    </b>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="busi_type?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="busi_type?.status === 'Active'"
                                                        @change="businessTypeStatusChange(busi_type?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ busi_type?.status }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                {{ busi_type?.created_by }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editBusinessType(busi_type?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteBusinessType(busi_type?.id)">
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
        <CreateBusinessType @load-business-type="refreshBusinessType" :accessOptions="businessAccessOptions" />
        <UpdateBusinessType @load-business-type="refreshBusinessType" :accessOptions="businessAccessOptions"
            :businessTypeInfo="updateBusinessTypeInfo" />
    </div>
</template>

<script>
import CreateBusinessType from './CreateBusinessType.vue'
import UpdateBusinessType from './UpdateBusinessType.vue'
export default {
    components: {
        CreateBusinessType,
        UpdateBusinessType
    },
    data: function () {
        return {
            businessTypes: {},
            updateBusinessTypeInfo: {},
            businessAccessOptions: {},
            adminUsers: {},
            quarry: {
                parpage: 20,
                keyword: '',
                admin_id: '',
                status: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadBusinessType();
        this.loadAccessOptions();
        this.loadAdminUsers();
    },
    methods: {
        loadBusinessType() {
            axios.get("/admin/business-type/list", { params: this.quarry }).then((response) => {
                this.businessTypes = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        loadAccessOptions() {
            axios.get("/admin/load-bussiness/options").then((response) => {
                this.businessAccessOptions = response.data;
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: 'Error',
                        message: `Error fetching data for ${error}`,
                    });
                }
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
        addBusinessType() {
            $("#createNewBusinessType").modal('show');
        },
        editBusinessType(id) {

            axios.get(`/admin/business-type/edit/${id}`).then((response) => {
                this.updateBusinessTypeInfo = response.data.data;
                $("#editBusinessType").modal('show');
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: 'Error',
                        message: `Error fetching data for ${error}`,
                    });
                }
            });
        },
        refreshBusinessType() {
            this.loadBusinessType();
        },
        deleteBusinessType(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/admin/business-type/delete/${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadBusinessType();
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
        clearLoadBusinessType() {
            this.quarry.parpage = 20;
            this.quarry.keyword = '';
            this.quarry.status = '';
            this.quarry.admin_id = '';
            this.loadBusinessType();
        },
        businessTypeStatusChange(id) {
            axios.get(`/admin/business-type/status/change/${id}`).then((response) => {
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.loadBusinessType();
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
        },
        businessAccessValue(access) {
            return this.businessAccessOptions[access] || access;
        },
    },
}
</script>

<style lang="scss" scoped></style>
