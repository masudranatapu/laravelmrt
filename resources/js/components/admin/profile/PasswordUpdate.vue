<template>
    <div>
        <form @submit.prevent="updatePassword()">
            <div class="card-header">
                <h4>Update Password</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label>
                            Old Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input :type="showOldPassword ? 'text' : 'password'" v-model="password.old_password"
                                class="form-control" placeholder="Old Password">
                            <div class="input-group-prepend" @click="passwordVisibility('old_pass')">
                                <div class="input-group-text">
                                    <i :class="showOldPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label>
                            New Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input :type="showNewPassword ? 'text' : 'password'" v-model="password.password"
                                class="form-control" placeholder="New Password">
                            <div class="input-group-prepend" @click="passwordVisibility('new_pass')">
                                <div class="input-group-text">
                                    <i :class="showNewPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label>
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input :type="showConfirmPassword ? 'text' : 'password'"
                                v-model="password.password_confirmation" class="form-control"
                                placeholder="Password Confirmation">
                            <div class="input-group-prepend" @click="passwordVisibility('confirm_pass')">
                                <div class="input-group-text">
                                    <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-warning mr-2" @click="clearFormValue()">
                    Clear
                </button>
                <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                    :disabled="isButtonDisabled">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    props: ['userinfo'],
    data: function () {
        return {
            password: {},
            isButtonDisabled: false,
            showOldPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updatePassword() {
            this.isButtonDisabled = true;
            axios.post(`/admin/password-update/${this.userinfo.id}`, this.password).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.clearFormValue();
                } else {
                    this.$iziToast.success({
                        title: this.$t('Error'),
                        message: this.$t(response.data.message),
                    });
                }
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
        clearFormValue() {
            this.password.old_password = '';
            this.password.password = '';
            this.password.password_confirmation = '';
        },
        passwordVisibility(value) {
            if (value === 'confirm_pass') {
                this.showConfirmPassword = !this.showConfirmPassword;
            } else if (value === 'new_pass') {
                this.showNewPassword = !this.showNewPassword;
            } else if (value === 'old_pass') {
                this.showOldPassword = !this.showOldPassword;
            } else {
                alert('Something went worng');
            }
        }
    },
};
</script>

<style lang="scss" scoped></style>
