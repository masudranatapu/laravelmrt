<template>
    <div>
        <div class="modal fade" id="updateData" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('Create Testimonial') }}
                        </h5>
                        <a href="javascript:;" @click="closeData()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="updateData(editData.id)">
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
                                                    <i class="fas fa-gift"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="editData.name"
                                                :placeholder="$t('Name')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Designation') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="editData.designation"
                                                :placeholder="$t('Designation')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Image') }}
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <input type="file" class="form-control" id="editImage">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Rating') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-code-branch"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.rating" required>
                                                <option value="1" :selected="editData.rating == 1">
                                                    1 Star Rating
                                                </option>
                                                <option value="2" :selected="editData.rating == 2">
                                                    2 Star Rating
                                                </option>
                                                <option value="3" :selected="editData.rating == 3">
                                                    3 Star Rating
                                                </option>
                                                <option value="4" :selected="editData.rating == 4">
                                                    4 Star Rating
                                                </option>
                                                <option value="5" :selected="editData.rating == 5">
                                                    5 Star Rating
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-money-bill-alt"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" required v-model="editData.status">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Review') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control" v-model="editData.review"
                                                :placeholder="$t('Review')" cols="30" rows="10" required></textarea>
                                        </div>
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
    props: ['editData'],
    data: function () {
        return {
            testimonial: {
                name: "",
                designation: "",
                image: "",
                review: "",
                rating: 5,
            },
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        updateData(id) {

            this.isButtonDisabled = true;

            var formData = new FormData();

            var editImage = $("#editImage")[0].files;

            if (editImage.length > 0) {

                var name = editImage[0].name;

                var extension = name.split('.').pop().toLowerCase();
                console.log(extension, name);

                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'webp']) == -1) {
                    this.$iziToast.error({
                        title: this.$t('Success'),
                        message: this.$t("Invalid Included Image File Extension"),
                    });
                    $("#editImage").val('');
                } else {
                    formData.append("image", editImage[0]);
                }

            }

            formData.append("name", this.editData.name ? this.editData.name : '');
            formData.append("designation", this.editData.designation ? this.editData.designation : '');
            formData.append("review", this.editData.review ? this.editData.review : '');
            formData.append("rating", this.editData.rating ? this.editData.rating : '');
            formData.append("_method", 'patch');
            formData.append("id", this.editData.id);

            axios.post(`/admin/testimonial/${id}`, formData).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });

                    this.$emit('load-data');

                    $("#editImage").val('');

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
            $("#editImage").val('');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
