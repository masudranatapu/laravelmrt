<template>
    <div>
        <div class="modal fade" id="createPackage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            Create Package
                        </h5>
                        <a href="javascript:;" @click="closeCreatePackage()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNewPackage()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="form-group">
                                        <label>
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-gift"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="package.title"
                                                placeholder="Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Price
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="package.price"
                                                placeholder="Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Installment Fee
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="package.installment_fee"
                                                placeholder="Installment Fee">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Branch Limit
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-code-branch"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="package.branch_limit"
                                                placeholder="Branch Limit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            User Limit
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <input type="numbar" class="form-control" v-model="package.user_limit"
                                                placeholder="User Limit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Product Limit
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-product-hunt"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="package.product_limit"
                                                placeholder="Product Limit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" v-model="package.description"
                                            placeholder="Description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center my-3">
                                    <h3>
                                        Business Access
                                    </h3>
                                </div>
                                <div class="col-md-3" v-for="(access, index) in accessOptions" :key="index">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                v-model="package.setting_access" :id="'optionCheck_' + index"
                                                :value="index" />
                                            <label :for="'optionCheck_' + index" class="custom-control-label">
                                                {{ access }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeCreatePackage()">
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
    props: ['accessOptions'],
    data: function () {
        return {
            package: {
                title: "",
                price: "",
                installment_fee: "",
                branch_limit: "",
                user_limit: "",
                product_limit: "",
                description: "",
                setting_access: [],
            },
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        addNewPackage() {
            this.isButtonDisabled = true;
            axios.post(`/admin/package/store`, this.package).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });

                    this.$emit('load-package');

                    this.package.title = "";
                    this.package.price = "";
                    this.package.installment_fee = ""
                    this.package.branch_limit = "";
                    this.package.user_limit = "";
                    this.package.product_limit = "";
                    this.package.description = ""
                    this.package.setting_access = '';

                    $("#createPackage").modal('hide');
                } else {
                    this.$iziToast.error({
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
        closeCreatePackage() {
            $("#createPackage").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
