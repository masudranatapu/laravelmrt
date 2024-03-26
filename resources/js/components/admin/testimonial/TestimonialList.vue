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
                                    <button type="button" class="btn btn-primary" @click="addTestimonial()">
                                        <i class="fa fa-plus"></i>
                                        Add New Testimonial
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
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
                                        <option value="">All</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadTestimonial()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearLoadTestimonial()">
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
                                                        @click="editTestimonial(testimonial?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteTestimonial(testimonial?.id)">
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
        <CreateTestimonial @load-testimonial="refreshTestimonial" />
        <UpdateTestimonial @load-testimonial="refreshTestimonial" :testimonialInfo="updateTestimonialInfo" />
    </div>
</template>

<script>
import CreateTestimonial from './CreateTestimonial.vue'
import UpdateTestimonial from './UpdateTestimonial.vue'
export default {
    components: {
        CreateTestimonial,
        UpdateTestimonial
    },
    data: function () {
        return {
            testimonials: {},
            updateTestimonialInfo: {},
            quarry: {
                parpage: 20,
                rating: '',
                status: '',
                create_by: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadTestimonial();
        this.loadUsers();
    },
    methods: {
        loadTestimonial() {
            axios.get("/testimonial-list", { params: this.quarry }).then((response) => {
                this.testimonials = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        loadUsers() {
            axios.get("/user/list").then((response) => {
                this.creators = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        addTestimonial() {
            $("#createNewTestimonial").modal('show');
        },
        editTestimonial(id) {
            axios.get(`/testimonial/edit/${id}`).then((response) => {
                this.updateTestimonialInfo = response.data.data;
                $("#editTestimonial").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        refreshTestimonial() {
            this.loadTestimonial();
        },
        deleteTestimonial(id) {
            this.$swal.fire({
                title: this.$t('Are you sure?'),
                text: this.$t('You won\'t be able to revert this!'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: this.$t('Yes, Delete it!'),
                cancelButtonText: this.$t('No, Cancel'),
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/testimonial/delete/${id}`).then((response) => {
                        this.isButtonDisabled = false;
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: this.$t('Success'),
                                message: this.$t(response.data.message),
                            });
                            this.loadTestimonial();
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
        clearLoadTestimonial() {
            this.quarry.parpage = 20;
            this.quarry.keyword = '';
            this.quarry.create_by = '';
            this.loadTestimonial();
        },
        testimonialStatusChange(id) {
            axios.get(`/testimonial/status/change/${id}`).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.loadTestimonial();
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
