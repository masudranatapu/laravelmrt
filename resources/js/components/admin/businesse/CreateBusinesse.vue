<template>
    <div>
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                                </div>
                                            </div>
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
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            businesse: {
                name: '',
            },
            showPassword: false,
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    methods: {
        createNewBusiness() {
            this.isButtonDisabled = true;
        },
        cancelNewBusiness() {
            this.isButtonDisabled = false;
            this.businesse.name = ''
        },
        passwordVisibility() {
            this.showPassword = !this.showPassword;
        }
    },
};
</script>

<style lang="scss" scoped></style>