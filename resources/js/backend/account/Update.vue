<template>
    <div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('Edit Account') }}
                        </h5>
                        <a href="javascript:;" @click="closeUpdate()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="update()">
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
                                            <select class="form-control" v-model="editData.type" required >
                                                <option v-for="(account_type, index) in account_types" :value="account_type" :selected="editData.type === account_type">
                                                    {{ account_type }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="editData.type == 'Mobile Banking'">
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
                                            <select class="form-control" v-model="editData.mobile_bank_name" required >
                                                <option v-for="(mobile_banking_name, index) in mobile_banking_names" :value="mobile_banking_name" :selected="editData.mobile_bank_name === mobile_banking_name">
                                                    {{ mobile_banking_name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="editData.type == 'Mobile Banking'">
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
                                            <input type="number" class="form-control" v-model="editData.mobile_number"
                                                :placeholder="$t('017...')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="editData.type == 'Mobile Banking'">
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
                                            <input step="any" type="number" class="form-control" v-model="editData.pm_charge" :placeholder="$t('1.8')" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdate()">
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
    props: ['editData', 'account_types', 'mobile_banking_names'],
    data: function () {
        return {
            isButtonDisabled: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
    },
    methods: {
        update() {
            this.isButtonDisabled = true;

            var formData = new FormData();
            formData.append('type', this.editData.type ? this.editData.type : '');
            formData.append('mobile_bank_name', this.editData.mobile_bank_name ? this.editData.mobile_bank_name : '');
            formData.append('mobile_number', this.editData.mobile_number ? this.editData.mobile_number : '');
            formData.append('pm_charge', this.editData.pm_charge ? this.editData.pm_charge : '');
            formData.append('_method','patch');

            axios.post(`/account/${this.editData.id}`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#edit_image").val('');
                    this.$emit('load-data');
                    $("#edit").modal('hide');
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
        closeUpdate() {
            $("#edit").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
