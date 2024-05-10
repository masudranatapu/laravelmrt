<template>
    <div>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <!-- modal-lg when more input need -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('Create Account') }}
                        </h5>
                        <a href="javascript:;" @click="closeCreate()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNewData()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Type') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="account.account_type" required >
                                                <option value="">Select One</option>
                                                <option v-for="(account_type, index) in account_types" :value="account_type">
                                                    {{ account_type }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="account.account_type == 'Mobile Banking'">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Mobile Bank Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="account.mobile_bank_name" >
                                                <option value="">Select One</option>
                                                <option v-for="(mobile_banking_name, index) in mobile_banking_names" :value="mobile_banking_name">
                                                    {{ mobile_banking_name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="account.account_type == 'Mobile Banking'">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Phone') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="account.mobile_number"
                                                :placeholder="$t('Phone')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="account.account_type == 'Mobile Banking'">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Service Charge (%)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input step="any" type="number" class="form-control" v-model="account.pm_charge" :placeholder="$t('Amount like 1.8')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeCreate()">
                                {{ $t('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                                :disabled="isButtonDisabled">
                                {{ $t('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['account_types', 'mobile_banking_names'],
    data: function () {
        return {
            account: {
                account_type: "",
                mobile_bank_name: "",
                mobile_number: "",
                pm_charge: "",
            },
            isButtonDisabled: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        addNewData() {

            this.isButtonDisabled = true;

            var formData = new FormData();

            formData.append('account_type', this.account.account_type ? this.account.account_type : '');
            formData.append('mobile_bank_name', this.account.mobile_bank_name ? this.account.mobile_bank_name : '');
            formData.append('mobile_number', this.account.mobile_number ? this.account.mobile_number : '');
            formData.append('pm_charge', this.account.pm_charge ? this.account.pm_charge : '');

            axios.post(`/account`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#image").val('');
                    this.$emit('load-data');
                    this.account.name = "";
                    this.account.email = "";
                    this.account.phone = "";
                    this.account.due = "";
                    this.account.address = "";
                    this.account.note = "";
                    $("#create").modal('hide');
                } else {
                    this.$iziToast.error({
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
        closeCreate() {
            $("#create").modal('hide');
            this.isButtonDisabled = false;
            this.account = {};
        },
    },
}
</script>

<style lang="scss" scoped></style>
