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
                        <input type="password" v-model="password.old_password" class="form-control"
                            placeholder="Old Password">
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label>
                            New Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" v-model="password.password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="form-group col-md-12 col-sm-12">
                        <label>
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" v-model="password.password_confirmation" class="form-control"
                            placeholder="Password Confirmation">
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
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updatePassword() {
            this.isButtonDisabled = true;
            axios.post(`/password-update/${this.userinfo.id}`, this.password).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.clearFormValue();
                } else {
                    this.$iziToast.success({
                        title: 'Error',
                        message: response.data.message,
                    });
                }
            }).catch((error) => {
                this.isButtonDisabled = false;
                let errors = error.response.data.errors;
                Object.keys(errors).forEach((key) => {
                    const value = errors[key];
                    this.$iziToast.error({
                        title: 'Error',
                        message: `${value}`,
                    });
                });
            });
        },
        clearFormValue() {
            this.password.old_password = '';
            this.password.password = '';
            this.password.password_confirmation = '';
        }
    },
};
</script>

<style lang="scss" scoped></style>
