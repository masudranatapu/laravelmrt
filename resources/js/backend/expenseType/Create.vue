<template>
    <div>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('Create New Expense Type') }}
                        </h5>
                        <a href="javascript:;" @click="closeCreate()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNew()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-address-card"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="expenseType.expense_type_name"
                                                :placeholder="$t('Name')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('Sort Index') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-arrows-alt-v"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" v-model="expenseType.sorting_number"
                                                :placeholder="$t('Sort Index')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeCreate()">
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
    props: ['categories'],
    data: function () {
        return {
            expenseType: {},
            isButtonDisabled: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        addNew() {
            this.isButtonDisabled = true;
            axios.post(`/expense-types`, this.expenseType).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.$emit('load-expense-types');
                    $("#create").modal('hide');
                    this.expenseType.name = "";
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
        closeCreate() {
            $("#create").modal('hide');
            this.isButtonDisabled = false;
            this.expenseType.name = "";
        },
    },
}
</script>

<style lang="scss" scoped></style>
