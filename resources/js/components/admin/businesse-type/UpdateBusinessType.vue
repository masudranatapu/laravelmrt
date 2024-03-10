<template>
    <div>
        <div class="modal fade" id="editBusinessType" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            Update Business Type
                        </h5>
                        <a href="javascript:;" @click="closeUpdateBusinessType()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateBusinessType(businessTypeInfo?.id)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Business Type Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"
                                                v-model="businessTypeInfo.business_type_name"
                                                placeholder="Business Type Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="businessTypeInfo.status">
                                                <option value="Active" :selected="businessTypeInfo.status === 'Active'">
                                                    Active
                                                </option>
                                                <option value="Inactive"
                                                    :selected="businessTypeInfo.status === 'Inactive'">
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center my-3">
                                    <h3>Business Access</h3>
                                </div>
                                <div class="col-md-3" v-for="(options, key) in accessOptions" :key="key">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                v-model="businessTypeInfo.access" :value="key"
                                                :id="'editOption' + key" />
                                            <label :for="'editOption' + key" class="custom-control-label">
                                                {{ options }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdateBusinessType()">
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
    props: ['accessOptions', 'businessTypeInfo'],
    data: function () {
        return {
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateBusinessType(id) {
            this.isButtonDisabled = true;
            axios.post(`/admin/businesse-type/update/${id}`, this.businessTypeInfo).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.$emit('load-business-type');
                    $("#editBusinessType").modal('hide');
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
        closeUpdateBusinessType() {
            $("#editBusinessType").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
