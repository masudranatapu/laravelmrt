<template>
    <div>
        <div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Edit Supplier') }}
                        </h5>
                        <a href="javascript:;" @click="closeUpdateSupplier()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateSupplier(supplierEdit?.id)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="supplierEdit.name"
                                                :placeholder="$t('Name')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Supplier Business Name') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"
                                                v-model="supplierEdit.supplier_business_name"
                                                :placeholder="$t('Supplier Business Name')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                            <input type="number" class="form-control" v-model="supplierEdit.phone"
                                                :placeholder="$t('Phone')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Email') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" v-model="supplierEdit.email"
                                                :placeholder="$t('Email')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Image') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-file-image"></i>
                                                </div>
                                            </div>
                                            <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp" class="form-control" id="edit_supplier_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Gender') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-transgender"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="supplierEdit.gender">
                                                <option value="Male" selected>{{ $t('Male') }}</option>
                                                <option value="Female">{{ $t('Female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Date of Birth') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="date" class="form-control" v-model="supplierEdit.date_of_birth"
                                                :placeholder="$t('Date of Birth')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Due') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-sort-amount-up"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="supplierEdit.due"
                                                :placeholder="$t('Due')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Date') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <input type="date" class="form-control" v-model="supplierEdit.date"
                                                :placeholder="$t('Date')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Area') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="supplierEdit.area_id">
                                                <option v-for="( area, index ) in  areas " :value='area?.id'>
                                                    {{ area?.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Zip Code') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-infinity"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="supplierEdit.zip_code"
                                                :placeholder="$t('Zip Code')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('Address') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="supplierEdit.address"
                                                :placeholder="$t('Address')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('Note') }}</label>
                                        <textarea name="" class="form-control" v-model="supplierEdit.note"
                                            :placeholder="$t('Note')" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdateSupplier()">
                                {{ $t('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary"
                                :class="{ 'btn-progress': isButtonDisabled }" :disabled="isButtonDisabled">
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
    props: ['areas', 'supplierEdit'],
    data: function () {
        return {
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateSupplier(id) {

            this.isButtonDisabled = true;

            var formData = new FormData();

            var supplierImage = $("#edit_supplier_image")[0].files;

            if (supplierImage.length > 0) {

                var name = supplierImage[0].name;

                var extension = name.split('.').pop().toLowerCase();

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Include Image File Extension"),
                    });
                    $("#edit_supplier_image").val();
                } else {
                    formData.append("image", supplierImage[0]);
                }

            } else {
                formData.append("image", '');
            }

            formData.append('name', this.supplierEdit.name ? this.supplierEdit.name : '');
            formData.append('email', this.supplierEdit.email ? this.supplierEdit.email : '');
            formData.append('supplier_business_name', this.supplierEdit.supplier_business_name ? this.supplierEdit.supplier_business_name : '');
            formData.append('phone', this.supplierEdit.phone ? this.supplierEdit.phone : '');
            formData.append('gender', this.supplierEdit.gender ? this.supplierEdit.gender : '');
            formData.append('date_of_birth', this.supplierEdit.date_of_birth ? this.supplierEdit.date_of_birth : '');
            formData.append('due', this.supplierEdit.due ? this.supplierEdit.due : '');
            formData.append('date', this.supplierEdit.date ? this.supplierEdit.date : '');
            formData.append('area_id', this.supplierEdit.area_id ? this.supplierEdit.area_id : '');
            formData.append('zip_code', this.supplierEdit.zip_code ? this.supplierEdit.zip_code : '');
            formData.append('address', this.supplierEdit.address ? this.supplierEdit.address : '');
            formData.append('note', this.supplierEdit.note ? this.supplierEdit.note : '');

            axios.post(`/supplier/update/${id}`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#edit_supplier_image").val('');
                    this.$emit('update-load-supplier');
                    $("#editSupplier").modal('hide');
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
        closeUpdateSupplier() {
            $("#editSupplier").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
