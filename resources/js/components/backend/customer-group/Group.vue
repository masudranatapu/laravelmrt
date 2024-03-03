<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Groups</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addGroup()">
                                        <i class="fa fa-plus"></i>
                                        Add New Group
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option value="">User</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Searching"
                                        v-model="query.keyword">
                                </div>
                                <div class="col-md-2">
                                    <div class="btn-group mb-3" role="group">
                                        <button type="button" class="btn btn-success" @click="loadGroups()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">
                                                        SL No
                                                    </label>
                                                </div>
                                            </th>
                                            <th>Group Name</th>
                                            <th>Amount</th>
                                            <th>Create By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(group, index) in groups">
                                            <td class="p-0 text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'checked_' + group?.id">
                                                    <label :for="'checked_' + group?.id" class="custom-control-label">
                                                        # {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ group?.name }}</td>
                                            <td>{{ group?.amount }}</td>
                                            <td>{{ group?.create_by }}</td>
                                            <td>
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary" title="Edit">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger" title="Delete"
                                                        @click="deleteGroup(group?.id)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <CreateCustomerGroup @load-group="refreshGroup" />
        <UpdateCustomerGroup />
    </div>
</template>

<script>
import CreateCustomerGroup from './CreateGroup.vue'
import UpdateCustomerGroup from './UpdateGroup.vue'
export default {
    components: {
        CreateCustomerGroup,
        UpdateCustomerGroup
    },
    props: [],
    data: function () {
        return {
            groups: {},
            query: {
                parpage: 20,
                keyword: '',
                create_by: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadGroups();
    },
    methods: {
        loadGroups() {
            console.log(this.query);
            axios.get("/group-list?", this.query).then((response) => {
                this.groups = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        addGroup() {
            $("#createNewGroup").modal('show');
        },
        editGroup() {
            $("#editGroup").modal('show');
        },
        refreshGroup() {
            this.loadGroups();
        },
        deleteGroup(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/group/delete/${id}`).then((response) => {
                        this.isButtonDisabled = false;
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadGroups();
                        } else {
                            this.$iziToast.error({
                                title: 'Error',
                                message: response.data.message,
                            });
                        }
                    }).catch((error) => {
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
                } else {
                    this.$iziToast.info({
                        title: 'Cancelled',
                        message: 'Your data is safe now :)',
                    });
                }
            });
        }
    },
}
</script>

<style lang="scss" scoped></style>
