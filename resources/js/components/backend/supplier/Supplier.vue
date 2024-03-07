<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Suppliers</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addSupplier()">
                                        <i class="fa fa-plus"></i>
                                        Add New Supplier
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2">

                                </div>
                                <div class="form-group col-md-3">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Start date"
                                            v-model="quarry.start_date">
                                        <span class="input-group-text bg-success">To</span>
                                        <input type="date" class="form-control" placeholder="End Date"
                                            v-model="quarry.end_date">
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.status">
                                        <option value="">
                                            All
                                        </option>
                                        <option value="Active">
                                            Active
                                        </option>
                                        <option value="Inactive">
                                            Inactive
                                        </option>
                                        <option value="Blocked">
                                            Blocked
                                        </option>
                                        <option value="Pending">
                                            Pending
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" v-model="quarry.keyword"
                                        placeholder="Searching supplier name, phone, email, membership id, uid etc.">
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadSuppliers()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearSearch()">
                                            Clear
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;">
                                                Bulk Delete
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
                                        <tr v-for="(supplier, index) in suppliers">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'supplier_' + supplier?.id">
                                                    <label :for="'supplier_' + supplier?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <img :alt='supplier?.name' :src='supplier?.image' class="rounded-circle"
                                                    width="35" data-toggle="tooltip">
                                                {{ supplier?.name }}
                                            </td>
                                            <td class="text-center">
                                                <a :href='"tel:" + supplier?.phone'>
                                                    {{ supplier?.phone }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{ supplier?.area }}
                                            </td>
                                            <td class="text-center">
                                                {{ supplier?.date }}
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline mr-2">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        :class="getStatusButtonClass(supplier?.status)"
                                                        id="dropdownMenuButton3" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ supplier?.status }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Active')" type="button"
                                                            v-if="supplier?.status === 'Inactive' || supplier?.status === 'Pending' || supplier?.status === 'Blocked'">
                                                            Make Active
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Inactive')"
                                                            type="button"
                                                            v-if="supplier?.status === 'Active' || supplier?.status === 'Pending'">
                                                            Make Inactive
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Blocked')" type="button"
                                                            v-if="supplier?.status === 'Active' || supplier?.status === 'Pending'">
                                                            Block User
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Pending')" type="button"
                                                            v-if="supplier?.status === 'Active'">
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
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="viewSupplierInfo(supplier?.id)">
                                                            <i class="fa fa-eye"></i>
                                                            View
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="editSupplier(supplier?.id)">
                                                            <i class="fas fa-pen"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteSupplier(supplier?.id)">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </a>
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
        <CreateSupplier :areas="areas" @create-load-supplier="refreshSupplier" />
        <UpdateSupplier :areas="areas" :supplierEdit="updateSupplier" @update-load-supplier="refreshSupplier" />
        <ViewSupplier :supplierView="viewSupplier" />
    </div>
</template>

<script>
import CreateSupplier from './CreateSupplier.vue'
import UpdateSupplier from './UpdateSupplier.vue'
import ViewSupplier from './ViewSupplier.vue'
export default {
    components: {
        CreateSupplier,
        UpdateSupplier,
        ViewSupplier,
    },
    props: [],
    data: function () {
        return {
            quarry: {
                parPage: 20,
                keyword: '',
                start_date: '',
                end_date: '',
                status: ''
            },
            suppliers: {},
            updateSupplier: {},
            viewSupplier: {},
            areas: {},
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadSuppliers();
        this.loadAreas();
    },
    methods: {
        loadSuppliers() {
            axios.get("/supplier-list", { params: this.quarry }).then((response) => {
                // console.log(response);
                this.suppliers = response.data.data;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
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
        addSupplier() {
            $("#createSupplier").modal('show');
        },
        refreshSupplier() {
            this.loadSuppliers();
        },
        getStatusButtonClass(status) {
            return {
                'btn-info': status === 'Pending',
                'btn-success': status === 'Active',
                'btn-secondary': status === 'Inactive',
                'btn-danger': status === 'Blocked'
            };
        },
        editSupplier(id) {
            axios.get(`/supplier/edit/${id}`).then((response) => {
                this.updateSupplier = response.data.data;
                $("#editSupplier").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        changeStatus(id, changeStatus) {
            axios.get(`/supplier/status-change/${id}?status=${changeStatus}`).then((response) => {
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.loadSuppliers();
                } else {
                    this.$iziToast.error({
                        title: 'Error',
                        message: response.data.message,
                    });
                }

            }).catch((error) => {

                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });

            });
        },
        viewSupplierInfo(id) {
            axios.get(`/supplier/view/${id}`).then((response) => {
                if (response.data.data) {
                    this.viewSupplier = response.data.data;
                    $("#viewSupplier").modal('show');
                }
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });

            });
        },
        deleteSupplier(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/supplier/delete/${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadSuppliers();
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
                    // this.$swal.fire('Your data is safe now :)');
                }
            });
        },
        clearSearch() {
            this.quarry.parPage = 20;
            this.quarry.keyword = '';
            this.quarry.start_date = '';
            this.quarry.end_date = '';
            this.quarry.status = '';
            this.loadSuppliers();
        }
    },
}
</script>

<style lang="scss" scoped></style>
