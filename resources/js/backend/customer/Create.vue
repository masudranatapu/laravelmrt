<template>
    <div>
        <div class="modal fade" id="createData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Create Customer') }}
                        </h5>
                        <a href="javascript:;" @click="closeData()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNewData()">
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
                                            <input type="text" class="form-control" v-model="customer.name"
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
                                            <input type="email" class="form-control" v-model="customer.email"
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
                                            <input type="number" class="form-control" v-model="customer.phone"
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
                                            <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp" class="form-control" id="customer_image">
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
                                            <select class="form-control" v-model="customer.gender">
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
                                            <input type="number" class="form-control" v-model="customer.member_ship_id"
                                                :placeholder="$t('Membership Number')">
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
                                            <input type="date" class="form-control" v-model="customer.date_of_birth"
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
                                            <input type="number" class="form-control" v-model="customer.due"
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
                                            <select class="form-control" v-model="customer.customer_group_id">
                                                <option v-for="(group, index) in groups" :value='group?.id'>
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
                                            <input type="date" class="form-control" v-model="customer.date"
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
                                            <select class="form-control" v-model="customer.area_id">
                                                <option v-for="(area, index) in areas" :value='area?.id'>
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
                                            <input type="number" class="form-control" v-model="customer.zip_code"
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
                                            <input type="text" class="form-control" v-model="customer.address"
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
                                            <input type="number" class="form-control" v-model="customer.sorting_number"
                                                :placeholder="$t('Sort Index')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('Note') }}</label>
                                        <textarea name="" class="form-control" v-model="customer.note"
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
    props: ['groups', 'areas'],
    data: function () {
        return {
            customer: {
                name: "",
                email: "",
                phone: "",
                gender: "",
                member_ship_id: "",
                date_of_birth: "",
                due: "",
                customer_group_id: "",
                date: "",
                area_id: "",
                zip_code: "",
                address: "",
                sorting_number: "",
                note: "",
            },
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        addNewData() {

            this.isButtonDisabled = true;

            var formData = new FormData();

            var customerImage = $("#customer_image")[0].files;

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

            formData.append('name', this.customer.name);
            formData.append('email', this.customer.email);
            formData.append('phone', this.customer.phone);
            formData.append('gender', this.customer.gender);
            formData.append('member_ship_id', this.customer.member_ship_id);
            formData.append('date_of_birth', this.customer.date_of_birth);
            formData.append('due', this.customer.due);
            formData.append('customer_group_id', this.customer.customer_group_id);
            formData.append('date', this.customer.date);
            formData.append('area_id', this.customer.area_id);
            formData.append('zip_code', this.customer.zip_code);
            formData.append('address', this.customer.address);
            formData.append('sorting_number', this.customer.sorting_number);
            formData.append('note', this.customer.note);

            axios.post(`/customer`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#customer_image").val('');
                    this.$emit('load-data');
                    this.customer.name = "";
                    this.customer.email = "";
                    this.customer.phone = "";
                    this.customer.gender = "";
                    this.customer.member_ship_id = "";
                    this.customer.date_of_birth = "";
                    this.customer.due = "";
                    this.customer.customer_group_id = "";
                    this.customer.date = "";
                    this.customer.area_id = "";
                    this.customer.zip_code = "";
                    this.customer.address = "";
                    this.customer.sorting_number = "";
                    this.customer.note = "";
                    $("#createData").modal('hide');
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
            $("#createData").modal('hide');
            this.isButtonDisabled = false;
            this.customer = "";
        },
    },
}
</script>

<style lang="scss" scoped></style>
