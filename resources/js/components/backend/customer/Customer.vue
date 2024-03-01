<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customers</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addCustomer()">
                                        <i class="fa fa-plus"></i>
                                        Add New Customer
                                    </button>
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
                                                    <label for="checkbox-all" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Progress</th>
                                            <th>Members</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, index) in customers">
                                            <td class="p-0 text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'checked_' + customer?.id">
                                                    <label :for="'checked_' + customer?.id" class="custom-control-label">
                                                        # {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ customer?.name }}</td>
                                            <td class="align-middle">
                                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                                    <div class="progress-bar bg-success" data-width="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle"
                                                    width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                            </td>
                                            <td>2018-01-20</td>
                                            <td>
                                                <div class="badge badge-success">Completed</div>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Detail</a>
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
        <CreateCustomer />
        <UpdateCustomer />
    </div>
</template>

<script>
import CreateCustomer from './CreateCustomer.vue'
import UpdateCustomer from './UpdateCustomer.vue'
export default {
    components: {
        CreateCustomer,
        UpdateCustomer
    },
    props: [],
    data: function () {
        return {
            customers: {},
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadCustomer();
    },
    methods: {
        loadCustomer() {
            axios.get("/customer-list").then((response) => {
                // console.log(response);
                this.user = response.data;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        addCustomer() {
            $("#createCustomer").modal('show');
        },
        editCustomer() {
            $("#editCustomer").modal('show');
        },
        refreshCustomer() {
            this.loadCustomer();
        },
    },
}
</script>

<style lang="scss" scoped></style>