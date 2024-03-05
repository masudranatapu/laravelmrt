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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning">
                                            Clear
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;">
                                                Delete
                                            </a>
                                        </div>
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
                                            <th>
                                                Name
                                            </th>
                                            <th class="text-center">
                                                Phone
                                            </th>
                                            <th class="text-center">
                                                Area
                                            </th>
                                            <th class="text-center">
                                                Date
                                            </th>
                                            <th class="text-center">
                                                Status
                                            </th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, index) in customers">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'checked_' + customer?.id">
                                                    <label :for="'checked_' + customer?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <img :alt='customer?.name' :src='customer?.image' class="rounded-circle" width="35" data-toggle="tooltip">
                                                {{ customer?.name }}
                                            </td>
                                            <td class="text-center">
                                                <a :href='"tel:" + customer?.phone'>
                                                    {{ customer?.phone }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{ customer?.area }}
                                            </td>
                                            <td class="text-center">
                                                {{ customer?.date }}
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline mr-2">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        :class="getStatusButtonClass(customer?.status)"
                                                        id="dropdownMenuButton3" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ customer?.status }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <button class="dropdown-item" type="button">
                                                            Make Active
                                                        </button>
                                                        <button class="dropdown-item" type="button">
                                                            Make Inactive
                                                        </button>
                                                        <button class="dropdown-item" type="button">
                                                            Block User
                                                        </button>
                                                        <button class="dropdown-item" type="button">
                                                            Pending
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <button class="dropdown-item has-icon" type="button">
                                                            <i class="fa fa-eye"></i>
                                                            View
                                                        </button>
                                                        <button class="dropdown-item has-icon" type="button">
                                                            <i class="fas fa-pen"></i>
                                                            Edit
                                                        </button>
                                                        <button class="dropdown-item has-icon" type="button">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </button>
                                                    </div>
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
        <CreateCustomer :groups="groups" :areas="areas" />
        <UpdateCustomer :groups="groups" :areas="areas" />
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
            groups: {},
            areas: {},
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadCustomer();
        this.loadGroups();
        this.loadAreas();
    },
    methods: {
        loadCustomer() {
            axios.get("/customer-list").then((response) => {
                // console.log(response);
                this.customers = response.data.data;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        loadGroups() {
            axios.get("/load-group").then((response) => {
                this.groups = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        loadAreas() {
            axios.get("/load-area").then((response) => {
                this.areas = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
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
        getStatusButtonClass(status) {
            return {
                'btn-info': status === 'Pending',
                'btn-success': status === 'Active',
                'btn-secondary': status === 'Inactive',
                'btn-danger': status === 'Blocked'
            };
        }
    },
}
</script>

<style lang="scss" scoped></style>
