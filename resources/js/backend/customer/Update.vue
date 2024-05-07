<template>
    <div>
        <div class="modal fade" id="updateData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Edit Customer') }}
                        </h5>
                        <a href="javascript:;" @click="closeData()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateDataInfo(editData.id)">
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
                                            <input type="text" class="form-control" v-model="editData.name"
                                                :placeholder="$t('Name')" required>
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
                                            <input type="email" class="form-control" v-model="editData.email"
                                                :placeholder="$t('Email')">
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
                                            <input type="number" class="form-control" v-model="editData.phone"
                                                :placeholder="$t('Phone')" required>
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
                                            <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp" class="form-control" id="edit_customer_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Gender') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-transgender"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.gender">
                                                <option value="Male" selected>{{ $t('Male') }}</option>
                                                <option value="Female">{{ $t('Female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Membership Number') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control"
                                                v-model="editData.member_ship_id" :placeholder="$t('Membership Number')">
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
                                            <input type="date" class="form-control" v-model="editData.date_of_birth"
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
                                            <input type="number" class="form-control" v-model="editData.due"
                                                :placeholder="$t('Due')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Customer Group') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.customer_group_id">
                                                <option v-for="(group, index) in groups" :value='group?.id'
                                                    :selected="customerEdit.customer_group_id == group?.id">
                                                    {{ group?.name }}
                                                </option>
                                            </select>
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
                                            <input type="date" class="form-control" v-model="editData.date"
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
                                            <select class="form-control" v-model="editData.area_id">
                                                <option v-for="(area, index) in areas" :value='area?.id'
                                                    :selected="customerEdit.area_id == area?.id">
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
                                            <input type="number" class="form-control" v-model="editData.zip_code"
                                                :placeholder="$t('Zip Code')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{ $t('Address') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-location-arrow"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="editData.address"
                                                :placeholder="$t('Address')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ $t('Sort Index') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-arrows-alt-v"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="editData.sorting_number"
                                                :placeholder="$t('Sort Index')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('Note') }}</label>
                                        <textarea name="" class="form-control" v-model="editData.note"
                                            :placeholder="$t('Note')" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeData()">
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
    props: ['groups', 'areas', 'editData'],
    data: function () {
        return {
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateDataInfo(id) {

            this.isButtonDisabled = true;

            var formData = new FormData();

            var customerImage = $("#edit_customer_image")[0].files;

            if (customerImage.length > 0) {

                var name = customerImage[0].name;

                var extension = name.split('.').pop().toLowerCase();

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Include Image File Extension"),
                    });
                    $("#customerImage").val();
                } else {
                    formData.append("image", customerImage[0]);
                }

            } else {
                formData.append("image", '');
            }

            formData.append('name', this.editData.name ? this.editData.name : '');
            formData.append('email', this.editData.email ? this.editData.email : '');
            formData.append('phone', this.editData.phone ? this.editData.phone : '');
            formData.append('gender', this.editData.gender ? this.editData.gender : '');
            formData.append('member_ship_id', this.editData.member_ship_id ? this.editData.member_ship_id : '');
            formData.append('date_of_birth', this.editData.date_of_birth ? this.editData.date_of_birth : '');
            formData.append('due', this.editData.due ? this.editData.due : '');
            formData.append('customer_group_id', this.editData.customer_group_id ? this.editData.customer_group_id : '');
            formData.append('date', this.editData.date ? this.editData.date : '');
            formData.append('area_id', this.editData.area_id ? this.editData.area_id : '');
            formData.append('zip_code', this.editData.zip_code ? this.editData.zip_code : '');
            formData.append('address', this.editData.address ? this.editData.address : '');
            formData.append('sorting_number', this.editData.sorting_number ? this.editData.sorting_number : '');
            formData.append('note', this.editData.note ? this.editData.note : '');
            formData.append('_method', 'patch');

            axios.post(`/customer/${id}`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#edit_customer_image").val('');
                    this.$emit('load-data');
                    $("#updateData").modal('hide');
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
        closeData() {
            $("#updateData").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
