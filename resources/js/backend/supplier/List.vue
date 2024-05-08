<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Suppliers') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addNewData()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Supplier') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-1">
                                    <select class="form-control" @change="loadData()" v-model="quarry.sort_order">
                                        <option value="asc">
                                            {{ $t('ASC') }}
                                        </option>
                                        <option value="desc">
                                            {{ $t('DESC') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" @change="loadData()" v-model="quarry.status">
                                        <option value="">
                                            {{ $t('All') }}
                                        </option>
                                        <option value="Active">
                                            {{ $t('Active') }}
                                        </option>
                                        <option value="Inactive">
                                            {{ $t('Inactive') }}
                                        </option>
                                        <option value="Blocked">
                                            {{ $t('Blocked') }}
                                        </option>
                                        <option value="Pending">
                                            {{ $t('Pending') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" v-model="quarry.keyword"
                                        placeholder="Searching supplier name, phone, email, membership id, uid etc.">
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadData()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearSearch()">
                                            {{ $t('Clear') }}
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $t('Action') }}
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;" @click="bulkDelete()">
                                                {{ $t('Bulk Delete') }}
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
                                                        id="checkbox-all" @click="allChecked()" v-model="all_checked">
                                                    <label for="checkbox-all" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                {{ $t('Name') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Phone') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Area') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Date') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Status') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(supplier, index) in suppliers">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'supplier_' + supplier?.id" :value="supplier?.id" v-model="checkedIds">
                                                    <label :for="'supplier_' + supplier?.id"
                                                        class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1
                                                        }}
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
                                                        {{ $t(supplier?.status) }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Active')" type="button"
                                                            v-if="supplier?.status === 'Inactive' || supplier?.status === 'Pending' || supplier?.status === 'Blocked'">
                                                            {{ $t('Make Active') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Inactive')"
                                                            type="button"
                                                            v-if="supplier?.status === 'Active' || supplier?.status === 'Pending'">
                                                            {{ $t('Make Inactive') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Blocked')" type="button"
                                                            v-if="supplier?.status === 'Active' || supplier?.status === 'Pending'">
                                                            {{ $t('Block User') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(supplier?.id, 'Pending')" type="button"
                                                            v-if="supplier?.status === 'Active'">
                                                            {{ $t('Pending') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ $t('Action') }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="viewInfo(supplier?.id)">
                                                            <i class="fa fa-eye"></i>
                                                            {{ $t('View') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="editInfo(supplier?.id)">
                                                            <i class="fas fa-pen"></i>
                                                            {{ $t('Edit') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteData(supplier?.id)">
                                                            <i class="fa fa-times"></i>
                                                            {{ $t('Delete') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="mr-auto">
                                    <span>
                                        Showing {{ metaData.from }} to {{ metaData.to }} of {{ metaData.total }}
                                        entries
                                    </span>
                                </div>
                                <div>
                                    <Pagination :data="metaData" @pagination-change-page="loadData" :limit="5">
                                    </Pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Create @load-data="refreshData" :areas="areas" />
        <Update @load-data="refreshData" :areas="areas" :editData="editData" />
        <View :viewInfoData="viewInfoData" />
    </div>
</template>

<script>
import Create from './Create.vue'
import Update from './Update.vue'
import View from './View.vue'
export default {
    components: {
        Create,
        Update,
        View,
    },
    props: [],
    data: function () {
        return {
            suppliers: {},
            editData: {},
            quarry: {
                per_page: 10,
                sort_order: 'asc',
                keyword: '',
                status: ''
            },
            metaData: {},
            checkedIds: [],
            all_checked: false,
            viewInfoData: {},
            areas: {},
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
        this.loadAreas();
    },
    methods: {
        loadData(page = 1) {
            axios.get(`/supplier-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.suppliers = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        loadAreas() {
            axios.get("/load-area").then((response) => {
                this.areas = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        addNewData() {
            $("#createSupplier").modal('show');
        },
        refreshData() {
            this.loadData();
        },
        getStatusButtonClass(status) {
            return {
                'btn-info': status === 'Pending',
                'btn-success': status === 'Active',
                'btn-secondary': status === 'Inactive',
                'btn-danger': status === 'Blocked'
            };
        },
        editInfo(id) {
            axios.get(`/supplier/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#updateData").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        changeStatus(id, changeStatus) {
            axios.get(`/supplier/status-change/${id}?status=${changeStatus}`).then((response) => {
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.loadData();
                } else {
                    this.$iziToast.error({
                        title: this.$t('Error'),
                        message: this.$t(response.data.message),
                    });
                }

            }).catch((error) => {

                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });

            });
        },
        viewInfo(id) {
            axios.get(`/supplier/${id}`).then((response) => {
                if (response.data.data) {
                    this.viewInfoData = response.data.data;
                    $("#viewInfoDataModal").modal('show');
                }
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });

            });
        },
        deleteData(id) {
            this.$swal.fire({
                title: this.$t('Are you sure?'),
                text: this.$t('You won\'t be able to revert this!'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: this.$t('Yes, Delete it!'),
                cancelButtonText: this.$t('No, Cancel'),
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/supplier-bulk-delete?ids=${id}`).then((response) => {
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: this.$t('Success'),
                                message: this.$t(response.data.message),
                            });
                            this.loadData();
                        } else {
                            this.$iziToast.error({
                                title: this.$t('Error'),
                                message: this.$t(response.data.message),
                            });
                        }
                    }).catch((error) => {
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
            this.quarry.per_page = 10;
            this.quarry.sort_order = 'asc';
            this.quarry.status = '';
            this.quarry.keyword = '';
            this.loadData();
        },
        allChecked() {
            if (this.checkedIds.length === this.suppliers.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.suppliers.map(supplier => supplier.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Suppliers Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>
