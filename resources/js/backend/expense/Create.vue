<template>
    <div>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('Create Expense') }}
                        </h5>
                        <a href="javascript:;" @click="closeCreate()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <form @submit.prevent="addNew()">
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
                                            <input type="date" class="form-control" v-model="expense.date"
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
                                            <select class="form-control">
                                                <option value="">One</option>
                                                <option value="">Two</option>
                                            </select>
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
                                            <select class="form-control" v-model="expense.account_type" required >
                                                <option v-for="(account_type, index) in account_types" :value="account_type" :selected="expense.account_type === account_type">
                                                    {{ account_type }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="expense.account_type == 'Cash'">
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
                                            <select class="form-control" v-model="expense.account_id" required >
                                                <option :value="cash_account.id" :selected="expense.account_id === cash_account.id">
                                                    {{ cash_account.text }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="expense.account_type == 'Mobile Banking'">
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
                                            <select class="form-control" v-model="expense.account_id" required >
                                                <option v-for="(mobile_banking, index) in mobile_bankings" :value="mobile_banking.id" :selected="expense.account_id === mobile_banking.id">
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
                                            <input step="any" type="number" class="form-control" v-model="expense.amount" :placeholder="$t('100..')" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ $t('Note') }}</label>
                                        <textarea name="" class="form-control" v-model="expense.note"
                                            :placeholder="$t('Note')" cols="30" rows="10"></textarea>
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
    components: { },
    props: ['account_types', 'expense_types', 'mobile_bankings'],
    data: function () {
        return {
            expense: {
                date: "",
                type: null,
                account_type: "Cash",
                account: "",
                amount: "",
                note: "",
            },
            cash_account: {},
            isButtonDisabled: false,
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {
        //
    },
    methods: {
        addNew() {
            this.isButtonDisabled = true;

            axios.post(`/admin/expense`, this.expense, {
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
                    $("#image").val('');
                    this.$emit('create-load-expense');
                    this.expense.date =  "",
                    this.expense.type =  null,
                    this.expense.account_type =  "Cash",
                    this.expense.account_id =  "",
                    this.expense.amount =  "",
                    this.expense.note =  "",
                    $("#create").modal('hide');
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
        closeCreate() {
            $("#create").modal('hide');
            this.isButtonDisabled = false;
            this.expense = {};
        },
    },
}
</script>

<style lang="scss" scoped></style>
