<template>
    <div>
        <div class="modal fade" id="updateInfoData" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Update Business Type') }}
                        </h5>
                        <a href="javascript:;" @click="closeUpdateData()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateData(editData?.id)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Business Type Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"
                                                v-model="editData.business_type_name"
                                                :placeholder="$t('Business Type Name')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.status">
                                                <option value="Active" :selected="editData.status === 'Active'">
                                                    {{ $t('Active') }}
                                                </option>
                                                <option value="Inactive" :selected="editData.status === 'Inactive'">
                                                    {{ $t('Inactive') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdateData()">
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
        updateData(id) {
            this.isButtonDisabled = true;
            this.editData._method = 'patch';
            axios.post(`/admin/business-type/${id}`, this.editData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.$emit('load-data');
                    $("#updateInfoData").modal('hide');
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
        closeUpdateData() {
            $("#updateInfoData").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
