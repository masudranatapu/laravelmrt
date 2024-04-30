<template>
    <div>
        <form @submit.prevent="updateProfile()">
            <div class="card-header">
                <h4>{{ $t('Edit Profile') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>{{ $t('Name') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" v-model="userinfo.name" :placeholder="$t('Name')">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>{{ $t('User Name') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" v-model="userinfo.username"
                                :placeholder="$t('User Name')">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>{{ $t('Email') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <input type="email" class="form-control" v-model="userinfo.email"
                                :placeholder="$t('Email')">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>{{ $t('Phone') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" v-model="userinfo.phone"
                                :placeholder="$t('Phone')">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-12">
                        <div class="form-group">
                            <label>
                                {{ $t('File') }}
                                <span class="text-success">
                                    ({{ $t('Image Ratio: 500X500') }})
                                </span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>
                                <input type="file" accept=".gif, .png, .jpg, .jpeg, .webp" class="form-control"
                                    id="profileImage">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>{{ $t('Gender') }}</label>
                        <div class="input-group">
                            <multiselect v-model="userinfo.gender" :options="gander_options" :searchable="false"
                                :close-on-select="true" :show-labels="true" placeholder="Select Gander">
                            </multiselect>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>{{ $t('Date of Birth') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" v-model="userinfo.date_of_birth"
                                :placeholder="$t('Date fo birth')">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-12">
                        <label>{{ $t('Country') }}</label>
                        <multiselect v-model="userinfo.country" :options="options" :searchable="false"
                            :close-on-select="true" :show-labels="true" placeholder="Select Country">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-8 col-12">
                        <label>{{ $t('Address') }}</label>
                        <input type="text" class="form-control" v-model="userinfo.address" :placeholder="$t('Address')">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>{{ $t('Bio') }}</label>
                        <textarea class="form-control" :placeholder="$t('Bio')"
                            v-model="userinfo.bio">{{ userinfo.bio }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                    :disabled="isButtonDisabled">
                    {{ $t('Save') }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['userinfo'],
    data: function () {
        return {
            isButtonDisabled: false,
            gander_options: ['Male', 'Female', 'Other'],
            options: ['Bangladesh', 'Pakistan', 'Bhutan', 'Nepal', 'Maldives', 'Sri Lanka', 'India'],
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateProfile() {

            this.isButtonDisabled = true;

            var formData = new FormData();

            var profileImage = $("#profileImage")[0].files;

            if (profileImage.length > 0) {

                var name = profileImage[0].name;

                var extension = name.split('.').pop().toLowerCase();

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Include Image File Extension"),
                    });
                    $("#profileImage").val();
                } else {
                    formData.append("image", profileImage[0]);
                }

            }

            formData.append("name", this.userinfo.name ? this.userinfo.name : "");
            formData.append("username", this.userinfo.username ? this.userinfo.username : "");
            formData.append("email", this.userinfo.email ? this.userinfo.email : "");
            formData.append("phone", this.userinfo.phone ? this.userinfo.phone : "");
            formData.append("gender", this.userinfo.gender ? this.userinfo.gender : "");
            formData.append("date_of_birth", this.userinfo.date_of_birth ? this.userinfo.date_of_birth : "");
            formData.append("country", this.userinfo.country ? this.userinfo.country : "");
            formData.append("address", this.userinfo.address ? this.userinfo.address : "");
            formData.append("bio", this.userinfo.bio ? this.userinfo.bio : "");
            formData.append("_method", "POST");
            axios.post(`/admin/profile-update/${this.userinfo.id}`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#profileImage").val('');

                    this.$emit('load-user');
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
    },
}
</script>

<style lang="scss" scoped></style>
