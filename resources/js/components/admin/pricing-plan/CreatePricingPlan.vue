<template>
    <div>
        <div class="modal fade" id="createNewPricingPlan" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            Create New Pricing Plan
                        </h5>
                        <a href="javascript:;" @click="closePricingPlan()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNewPricingPlan()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Month
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="number" v-model="pricingplan.month" class="form-control"
                                                placeholder="Month" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Discount Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-money-bill-alt"></i>
                                                </div>
                                            </div>
                                            <select @change="discountValueCheck()" class="form-control" required
                                                v-model="pricingplan.discount_type">
                                                <option value="Amount">Amount</option>
                                                <option value="Percentage">Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Discount Value
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-hand-holding-usd"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control"
                                                v-model="pricingplan.discount_value" placeholder="Value"
                                                @change="discountValueCheck()" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closePricingPlan()">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                                :disabled="isButtonDisabled">
                                Save
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
    props: [],
    data: function () {
        return {
            pricingplan: {
                discount_type: "Percentage",
            },
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        discountValueCheck() {
            if (this.pricingplan.discount_type === 'Percentage') {
                if (this.pricingplan.discount_value > 100) {
                    this.pricingplan.discount_value = 0;
                    this.$iziToast.error({
                        title: 'Error',
                        message: 'Discount percentage cannot exceed 100%',
                    });
                } else {
                    return true;
                }
            }
        },
        addNewPricingPlan() {
            this.isButtonDisabled = true;
            axios.post('/admin/pricing-plans/store', this.pricingplan).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.$emit('load-pricing-plan');
                    $("#createNewPricingPlan").modal('hide');
                    this.pricingplan.month = '';
                    this.pricingplan.discount_type = 'Percentage';
                    this.pricingplan.discount_value = '';
                } else {
                    this.$iziToast.error({
                        title: 'Error',
                        message: response.data.message,
                    });
                }
            }).catch((error) => {
                this.isButtonDisabled = false;
                if (error) {
                    let errors = error.response.data.errors;
                    Object.keys(errors).forEach((key) => {
                        const value = errors[key];
                        this.$iziToast.error({
                            title: 'Error',
                            message: `${value}`,
                        });
                    });
                } else {
                    this.$iziToast.error({
                        title: 'Error',
                        message: 'An error occurred while processing your request.',
                    });
                }
            });
        },
        closePricingPlan() {
            $("#createNewPricingPlan").modal('hide');
            this.isButtonDisabled = false;
            this.pricingplan.month = '';
            this.pricingplan.discount_type = 'Percentage';
            this.pricingplan.discount_value = '';
        },
    },
}
</script>

<style lang="scss" scoped></style>
