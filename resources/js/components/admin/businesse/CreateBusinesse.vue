<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Business</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <a :href="'/admin/businesses'" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        Business List
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="createNewBusiness()">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Businesse Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="businesse.name"
                                                    placeholder="Businesse Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Businesse Phone
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.phone"
                                                    placeholder="Businesse Phone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Business Start Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="date" class="form-control"
                                                    v-model="businesse.business_start_date"
                                                    placeholder="Business Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Businesse Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" v-model="businesse.email"
                                                    placeholder="Businesse Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Businesse Logo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-file-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" class="form-control" id="businesse_logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Businesse Favicon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-file-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" class="form-control" id="businesse_favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>City</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="businesse.city"
                                                    placeholder="City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-infinity"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="businesse.address"
                                                    placeholder="Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="businesse.user_name"
                                                    placeholder="User Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input :type="showPassword ? 'text' : 'password'" class="form-control"
                                                    v-model="businesse.password" placeholder="Password">
                                                <div class="input-group-prepend" @click="passwordVisibility()">
                                                    <div class="input-group-text">
                                                        <i
                                                            :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Pricing Plans
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="businesse.business_type_id"
                                                    required>
                                                    <option value="">Select One</option>
                                                    <option v-for="(busi_plan, index) in businesstype" :key="index"
                                                        :value="busi_plan?.id">
                                                        {{ busi_plan?.business_type_name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Pricing Plans
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="businesse.pricing_plan_id"
                                                    required>
                                                    <option value="">Select One</option>
                                                    <option v-for="(plan, index) in pricingplans" :key="index"
                                                        :value="plan?.id">
                                                        {{ plan?.month }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                Packages
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="businesse.package_id" required>
                                                    <option value="">Select One</option>
                                                    <option v-for="(pack_value, index) in packages" :key="index"
                                                        :value="pack_value?.id">
                                                        {{ pack_value?.title }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Monthly Service Charge</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-money-bill-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="Monthly Service Charge">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Installment Fees</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-money-bill-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="Installment Fees">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Business Branch Limit</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-code-branch"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>User Limit</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-users"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="User Limit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Limit</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-product-hunt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="businesse.zip_code"
                                                    placeholder="Product Limit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center my-3">
                                        <h3>Business Access</h3>
                                    </div>
                                    <div class="col-md-3" v-for="(access, index) in accessOptions" :key="index">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    v-model="businesse.access" :id="'optionCheck_' + index"
                                                    :value="index" />
                                                <label :for="'optionCheck_' + index" class="custom-control-label">
                                                    {{ access }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" @click="cancelNewBusiness()">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                        :class="{ 'btn-progress': isButtonDisabled }" :disabled="isButtonDisabled">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["packages", "pricingplans", "businesstype"],
    data: function () {
        return {
            business: {
                name: '',
                access: [],
            },
            accessOptions: {},
            showPassword: false,
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadAccessOptions();
    },
    methods: {
        loadAccessOptions() {
            axios.get("/admin/load-bussiness/options").then((response) => {
                this.accessOptions = response.data;
            }).catch((error) => {
                if (error) {
                    this.$iziToast.error({
                        title: 'Error',
                        message: `Error fetching data for ${error}`,
                    });
                }
            });
        },
        createNewBusiness() {
            alert('working submit');
        },
        cancelNewBusiness() {
            this.isButtonDisabled = false;
            this.business.name = ''
        },
        passwordVisibility() {
            this.showPassword = !this.showPassword;
        }
    },
};
</script>

<style lang="scss" scoped></style>
