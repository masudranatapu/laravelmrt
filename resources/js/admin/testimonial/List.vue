<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Testimonial</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addNewData()">
                                        <i class="fa fa-plus"></i>
                                        Add New Testimonial
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                                    <select class="form-control" v-model="quarry.create_by">
                                        <option value="">All</option>
                                        <option v-for="(creator, index) in creators" :value='creator?.id'>
                                            {{ creator?.name }}
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
                                    <select class="form-control" v-model="quarry.rating">
                                        <option value="">All Rating</option>
                                        <option value="1">1 Star Rating</option>
                                        <option value="2">2 Star Rating</option>
                                        <option value="3">3 Star Rating</option>
                                        <option value="4">4 Star Rating</option>
                                        <option value="5">5 Star Rating</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadData()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearSearch()">
                                            Clear
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;" @click="bulkDelete()">
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
                                            <th class="text-center">Group Name</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Create By</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(testimonial, index) in testimonials">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'testimonial_' + testimonial?.id" :value='testimonial?.id'>
                                                    <label :for="'testimonial_' + testimonial?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ testimonial?.name }}</td>
                                            <td class="text-center">{{ testimonial?.amount }}</td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="testimonial?.status === 'Active'"
                                                        @change="testimonialStatusChange(testimonial?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ testimonial?.status }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                {{ testimonial?.create_by }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editInfo(testimonial?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteData(testimonial?.id)">
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
            testimonials: {},
            editData: {},
            quarry: {
                per_page: 10,
                rating: '',
                status: '',
                create_by: '',
            },
            metaData: {},
            creators: {},
            checkedIds: [],
            all_checked: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
        this.loadUsers();
    },
    methods: {
        loadData() {
            axios.get(`/admin/testimonial-list`, { params: this.quarry }).then((response) => {
                this.testimonials = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        loadUsers() {
            axios.get(`/admin/load-admin/users`).then((response) => {
                this.creators = response.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        addNewData() {
            $("#createData").modal('show');
        },
        editInfo(id) {
            axios.get(`/testimonial/edit/${id}`).then((response) => {
                this.editData = response.data.data;
                $("#updateData").modal('show');
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
                    axios.get(`/testimonial-bulk-delete?ids=${id}`).then((response) => {
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
                } else {
                    this.$iziToast.info({
                        title: 'Cancelled',
                        message: 'Your data is safe now :)',
                    });
                }
            });
        },
        clearSearch() {
            this.quarry.per_page = 10;
            this.quarry.rating = '';
            this.quarry.status = '';
            this.quarry.create_by = '';
            this.loadData();
        },
        allChecked() {
            if (this.checkedIds.length === this.testimonials.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.testimonials.map(testimonial => testimonial.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Testimonial Not Select For This Action');
            }
        },
        testimonialStatusChange(id) {
            axios.get(`/testimonial/status/change/${id}`).then((response) => {
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
        }
    },
}
</script>

<style lang="scss" scoped></style>
