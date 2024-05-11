<template>
    <div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('Edit Expense') }}
                        </h5>
                        <a href="javascript:;" @click="closeUpdate()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="update()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Date') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="date" class="form-control" v-model="editData.date"
                                            :placeholder="$t('017...')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Expense Type') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <multiselect @search-change="pullExpenseTypes"
                                                v-model="editData.type" open-direction="bottom"
                                                :options="expense_types" :multiple="false"
                                                :close-on-select="true" :taggable="false"
                                                :clear-on-select="false" :allow-empty="false"
                                                :preserve-search="true" placeholder="Choose Expense Type"
                                                label="text" track-by="id" selectLabel=""
                                                deselectLabel="">
                                                <template slot="singleLabel" slot-scope="{ option }">
                                                    <strong>{{ option.text }}{{ option.id }}</strong>
                                                </template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Account Type') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.account_type" required >
                                                <option v-for="(account_type, index) in account_types" :value="account_type" :selected="editData.account_type === account_type">
                                                    {{ account_type }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="editData.account_type == 'Cash'">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.account_id" required >
                                                <option :value="cash_account.id" :selected="editData.account_id === cash_account.id">
                                                    {{ cash_account.text }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="editData.account_type == 'Mobile Banking'">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-check-square"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" v-model="editData.account_id" required >
                                                <option v-for="(mobile_banking, index) in mobile_bankings" :value="mobile_banking.id" :selected="editData.account_id === mobile_banking.id">
                                                    {{ mobile_banking.text }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ $t('Amount') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                            <input step="any" type="number" class="form-control" v-model="editData.amount" :placeholder="$t('100..')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Note') }}</label>
                                        <textarea name="" class="form-control" v-model="editData.note"
                                            :placeholder="$t('Note')" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdate()">
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
    props: ['editData', 'account_types', ],
    data: function () {
        return {
            expense_types: [],
            mobile_bankings: [],
            cash_account: {},
            isButtonDisabled: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.pullExpenseTypes();
        this.pullAccounts();
    },
    methods: {
        pullExpenseTypes: function (text = null) {
            axios.get(`/admin/ajax/expense-type-pagination?text=${text ?? ''}`)
            .then((response) => {
                this.expense_types = response.data.data;
            });
        },
        pullAccounts: function (text = null) {
            axios.get(`/admin/ajax/account-pagination?text=${text ?? ''}`)
            .then((response) => {
                this.mobile_bankings = response.data.data.mobile_bankings;
                this.cash_account = response.data.data.cash_account;
                // this.expense.account = response.data.data.cash_account.id;
            });
        },
        update() {
            this.isButtonDisabled = true;

            var formData = new FormData();
            formData.append('date', this.editData.date ? this.editData.date : '');

            Object.entries(this.editData.type).forEach(([key, value]) => formData.append(`type[${key}]`, value));

            formData.append('account_type', this.editData.account_type ? this.editData.account_type : '');
            formData.append('account_id', this.editData.account_id ? this.editData.account_id : '');
            formData.append('amount', this.editData.amount ? this.editData.amount : '');
            formData.append('note', this.editData.note ? this.editData.note : '');
            formData.append('_method','patch');

            axios.post(`/admin/expense/${this.editData.id}`,  formData, {
                headers: {
                    'Content-Type': 'multipart/form-data' // Set content type to multipart/form-data for file upload
                }
            }).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    $("#edit_image").val('');
                    this.$emit('update-load');
                    $("#edit").modal('hide');
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
        closeUpdate() {
            $("#edit").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
