<template>
    <div>
        <div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            Edit Group
                        </h5>
                        <a href="javascript:;" @click="closeUpdateGroup()">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form @submit.prevent="updateGroup(groupInfo?.id)">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Group Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="groupInfo.name"
                                                placeholder="Group Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Amount
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-money-bill"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" step="0.01" v-model="groupInfo.amount"
                                                placeholder="Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <select class="form-control" v-model="groupInfo.status">
                                                <option value="Active" :selected="groupInfo.status === 'Active'">
                                                    Active
                                                </option>
                                                <option value="Inactive" :selected="groupInfo.status === 'Inactive'">
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-warning" @click="closeUpdateGroup()">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary" :class="{ 'btn-progress': isButtonDisabled }"
                                :disabled="isButtonDisabled">
                                Save
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
    props: ['groupInfo'],
    data: function () {
        return {
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    methods: {
        updateGroup(id) {
            this.isButtonDisabled = true;
            axios.post(`/group/update/${this.groupInfo?.id}`, this.groupInfo).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.$emit('load-group');
                    $("#editGroup").modal('hide');
                } else {
                    this.$iziToast.error({
                        title: 'Error',
                        message: response.data.message,
                    });
                }
            }).catch((error) => {
                this.isButtonDisabled = false;
                if (error) {
                    let errors = error.response.data.errors;
                    Object.keys(errors).forEach((key) => {
                        const value = errors[key];
                        this.$iziToast.error({
                            title: 'Error',
                            message: `${value}`,
                        });
                    });
                } else {
                    this.$iziToast.error({
                        title: 'Error',
                        message: 'An error occurred while processing your request.',
                    });
                }
            });
        },
        closeUpdateGroup() {
            $("#editGroup").modal('hide');
            this.isButtonDisabled = false;
        },
    },
}
</script>

<style lang="scss" scoped></style>
