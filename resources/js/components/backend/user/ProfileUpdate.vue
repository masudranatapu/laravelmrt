<template>
    <div>
        <form @submit.prevent="updateProfile()">
            <div class="card-header">
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="userinfo.name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>User Name</label>
                        <input type="text" class="form-control" v-model="userinfo.username" placeholder="Username">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="userinfo.email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Phone</label>
                        <input type="number" class="form-control" v-model="userinfo.phone" placeholder="Phone">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-12">
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>Gender</label>
                        <select class="form-control selectric" v-model="userinfo.gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control datepicker" v-model="userinfo.date_of_birth"
                            placeholder="Date fo birth">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-12">
                        <label>Country</label>
                        <select class="form-control selectric" v-model="userinfo.country">
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="India">India</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8 col-12">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="userinfo.address" placeholder="Address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>Bio</label>
                        <textarea class="form-control" placeholder="Bio">{{ userinfo.bio }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-warning mr-2" @click="clearFormValue()">
                    Clear
                </button>
                <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                    :disabled="isButtonDisabled">
                    Save Changes
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
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateProfile() {
            this.isButtonDisabled = true;
            axios.post(`/profile-update/${this.userinfo.id}`, this.userinfo).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                } else {
                    this.$iziToast.success({
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
        clearFormValue() {
            
        }
    },
}
</script>

<style lang="scss" scoped></style>
