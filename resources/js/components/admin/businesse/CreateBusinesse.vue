<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Create Business') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <a :href="'/admin/businesses'" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Business List') }}
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
                                                {{ $t('Business') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="business.name"
                                                    :placeholder="$t('Business Name')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('Business Phone') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" v-model="business.phone"
                                                    :placeholder="$t('Business Phone')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Business Start Date') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="date" class="form-control"
                                                    v-model="business.business_start_date"
                                                    :placeholder="$t('Business Start Date')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Business Email') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" v-model="business.email"
                                                    :placeholder="$t('Business Email')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Business Logo') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-file-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp"
                                                    class="form-control" id="business_logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Business Favicon') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-file-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp"
                                                    class="form-control" id="business_favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ $t('City') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="business.city"
                                                    :placeholder="$t('City')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ $t('Zip Code') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-infinity"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="business.zip_code"
                                                    :placeholder="$t('Zip Code')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $t('Address') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="business.address"
                                                    :placeholder="$t('Address')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $t('User Name') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" v-model="business.user_name"
                                                    :placeholder="$t('User Name')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $t('Password') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input :type="showPassword ? 'text' : 'password'" class="form-control"
                                                    v-model="business.password" :placeholder="$t('Password')">
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
                                                {{ $t('Business Type') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="business.business_type_id">
                                                    <option value="" disabled>Select One</option>
                                                    <option v-for="(busi_plan, index) in business_types" :key="index"
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
                                                {{ $t('Pricing Plans') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="business.pricing_plan_id"
                                                    @change="pricingValue(event)">
                                                    <option value="" disabled>Select One</option>
                                                    <option v-for="(plan, index) in pricing_plans" :key="index"
                                                        :value="plan?.id">
                                                        {{ plan?.month }} {{ $t('Month') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                {{ $t('Packages') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="far fa-check-square"></i>
                                                    </div>
                                                </div>
                                                <select class="form-control" v-model="business.package_id"
                                                    @change="packageValue()">
                                                    <option value="" disabled>Select One</option>
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
                                            <label>{{ $t('Monthly Service Charge') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-money-bill-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" min="1" class="form-control"
                                                    v-model="business.service_charge"
                                                    :placeholder="$t('Monthly Service Charge')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ $t('Installment Fees') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-money-bill-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" min="1" class="form-control"
                                                    v-model="business.fees" :placeholder="$t('Installment Fees')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Business Branch Limit') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-code-branch"></i>
                                                    </div>
                                                </div>
                                                <input type="number" min="1" class="form-control"
                                                    v-model="business.branch_limit"
                                                    :placeholder="$t('Business Branch Limit')">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('User Limit') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-users"></i>
                                                    </div>
                                                </div>
                                                <input type="number" min="1" class="form-control"
                                                    v-model="business.user_limit" :placeholder="$t('User Limit')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ $t('Product Limit') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-product-hunt"></i>
                                                    </div>
                                                </div>
                                                <input type="number" min="1" class="form-control"
                                                    v-model="business.product_limit" :placeholder="$t('Product Limit')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center my-3">
                                        <h3>{{ $t('Business Access') }}</h3>
                                    </div>
                                    <div class="col-md-3" v-for="(access, index) in accessOptions" :key="index">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    v-model="business.option_access" :id="'optionCheck_' + index"
                                                    :value="index" />
                                                <label :for="'optionCheck_' + index" class="custom-control-label">
                                                    {{ access }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <h3>
                                            {{ $t('Price and Cost') }}
                                        </h3>
                                    </div>
                                    <div class="col-md-3 my-3">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between">
                                                {{ $t('Total Service Charge') }}
                                                <span class="badge badge-primary badge-pill">
                                                    {{ total_service_charge }} TK
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                {{ $t('Total Discount') }}
                                                <span class="badge badge-primary badge-pill">
                                                    {{ total_discount }}
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                {{ $t('Discount Type') }}
                                                <span class="badge badge-primary badge-pill">
                                                    {{ discount_type }}
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                {{ $t('After Discount') }}
                                                <span class="badge badge-primary badge-pill">
                                                    {{ after_discount }} TK
                                                </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                {{ $t('Total Amount') }}
                                                <span class="badge badge-primary badge-pill">
                                                    {{ total_amount }} TK
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" @click="cancelNewBusiness()">
                                        {{ $t('Cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                        :class="{ 'btn-progress': isButtonDisabled }" :disabled="isButtonDisabled">
                                        {{ $t('Save') }}
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
    props: ["packages", "pricing_plans", "business_types"],
    data: function () {
        return {
            business: {
                name: '',
                phone: '',
                business_start_date: '',
                email: '',
                city: '',
                zip_code: '',
                address: '',
                user_name: '',
                password: '',
                business_type_id: '',
                pricing_plan_id: '',
                package_id: '',
                service_charge: '',
                fees: '',
                branch_limit: '',
                user_limit: '',
                product_limit: '',
                option_access: [],
            },
            accessOptions: {},
            total_service_charge: 0,
            discount_type: '',
            total_discount: 0,
            after_discount: 0,
            total_amount: 0,
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
                        title: this.$t('Error'),
                        message: this.$t(`Fetching data has error. Please try again.`),
                    });
                }
            });
        },
        pricingValue() {
            axios.get(`/admin/pricing-plan/${this.business.pricing_plan_id}`).then((response) => {
                if (response.data) {
                    this.discount_type = response.data.discount_type;
                    this.total_discount = response.data.discount_value;
                } else {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Data not found"),
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        packageValue() {
            axios.get(`/admin/package-info/${this.business.package_id}`).then((response) => {
                if (response.data) {
                    if (this.discount_type === 'Percentage') {

                    } else {

                    }
                } else {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Data not found"),
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        createNewBusiness() {

            var formData = new FormData();

            var businessLogo = $("#business_logo")[0].files;
            var businessFavicon = $("#business_favicon")[0].files;

            if (businessLogo.length > 0) {

                var nameLogo = businessLogo[0].name;

                var extension = nameLogo.split('.').pop().toLowerCase();

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Include Image File Extension"),
                    });
                    $("#business_logo").val();
                } else {
                    formData.append("logo", businessLogo[0]);
                }

            } else {
                formData.append("logo", '');
            }

            if (businessFavicon.length > 0) {

                var nameFavicon = businessFavicon[0].name;

                var extension = nameFavicon.split('.').pop().toLowerCase();

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Include Image File Extension"),
                    });
                    $("#business_favicon").val();
                } else {
                    formData.append("favicon", businessFavicon[0]);
                }

            } else {
                formData.append("favicon", '');
            }

            formData.append('name', this.business.name ? this.business.name : '');
            formData.append('phone', this.business.phone ? this.business.phone : '');
            formData.append('business_start_date', this.business.business_start_date ? this.business.business_start_date : '');
            formData.append('email', this.business.email ? this.business.email : '');
            formData.append('city', this.business.city ? this.business.city : '');
            formData.append('zip_code', this.business.zip_code ? this.business.zip_code : '');
            formData.append('address', this.business.address ? this.business.address : '');
            formData.append('user_name', this.business.user_name ? this.business.user_name : '');
            formData.append('password', this.business.password ? this.business.password : '');
            formData.append('business_type_id', this.business.business_type_id ? this.business.business_type_id : '');
            formData.append('pricing_plan_id', this.business.pricing_plan_id ? this.business.pricing_plan_id : '');
            formData.append('package_id', this.business.package_id ? this.business.package_id : '');
            formData.append('service_charge', this.business.service_charge ? this.business.service_charge : '');
            formData.append('fees', this.business.fees ? this.business.fees : '');
            formData.append('branch_limit', this.business.branch_limit ? this.business.branch_limit : '');
            formData.append('user_limit', this.business.user_limit ? this.business.user_limit : '');
            formData.append('product_limit', this.business.product_limit ? this.business.product_limit : '');
            formData.append('option_access', this.business.option_access ? this.business.option_access : '');

            axios.post(`/admin/businesses/store`, formData).then((response) => {
                console.log(response);
            }).catch((error) => {
                this.isButtonDisabled = false;
                let errors = error.response.data.errors;
                Object.keys(errors).forEach((key) => {
                    const value = errors[key];
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: `${value}`,
                    });
                });
            });
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
