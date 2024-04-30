<template>
    <div>
        <div class="modal fade" id="editData" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Update Pricing Plan') }}
                        </h5>
                        <a href="javascript:;" @click="closePricingPlan()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateData(editData?.id)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Month') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="number" v-model="editData.month" class="form-control"
                                                :placeholder="$t('Month')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Discount Type') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-money-bill-alt"></i>
                                                </div>
                                            </div>
                                            <select @change="discountValueCheck()" class="form-control" required
                                                v-model="editData.discount_type">
                                                <option value="Amount" :selected="editData.discount_type === 'Amount'">
                                                    {{ $t('Amount') }}
                                                </option>
                                                <option value="Percentage"
                                                    :selected="editData.discount_type === 'Percentage'">
                                                    {{ $t('Percentage') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Discount Value') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-hand-holding-usd"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="editData.discount_value"
                                                :placeholder="$t('Value')" @change="discountValueCheck()" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closePricingPlan()">
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
    props: ['editData'],
    data: function () {
        return {
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        discountValueCheck() {
            if (this.editData.discount_type === 'Percentage') {
                if (this.editData.discount_value > 100) {
                    this.editData.discount_value = 0;
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t('Discount percentage cannot exceed 100%'),
                    });
                } else {
                    return true;
                }
            }
        },
        updateData(id) {
            this.isButtonDisabled = true;
            this.editData._method = 'patch';
            axios.post(`/admin/pricing-plans/${id}`, this.editData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.$emit('load-data');
                    $("#editData").modal('hide');
                } else {
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t(response.data.message),
                    });
                }
            }).catch((error) => {
                this.isButtonDisabled = false;
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
        },
        closePricingPlan() {
            $("#editData").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
