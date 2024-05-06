<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Packages') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addNewData()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Package') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" @change="loadData()"
                                            placeholder="Start date" v-model="quarry.start_date">
                                        <span class="input-group-text bg-success">{{ $t('To') }}</span>
                                        <input type="date" class="form-control" @change="loadData()"
                                            placeholder="End Date" v-model="quarry.end_date">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control" @change="loadData()"
                                        v-model="quarry.keyword" :placeholder="$t('Search')">
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
                                                {{ $t('Title') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('M. Service Charge') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Installment Fee') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('User Limit') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Customer Limit') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Supplier Limit') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Product Limit') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Branch Limit') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Created By') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $t('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(pack_value, index) in packages">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input"
                                                        :id="'pack_value_' + pack_value?.id" :value='pack_value?.id'
                                                        v-model="checkedIds">
                                                    <label :for="'pack_value_' + pack_value?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.title }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.monthly_service_charge }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.installment_fee }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.user_limit }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.customer_limit }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.supplier_limit }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.product_limit }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value.branch_limit }}
                                            </td>
                                            <td class="text-center">
                                                {{ pack_value?.admin }}
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
                                                            @click="editInfo(pack_value?.id)">
                                                            <i class="fas fa-pen"></i>
                                                            {{ $t('Edit') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteData(pack_value?.id)">
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
        <Create @load-data="refreshData" />
        <Update @load-data="refreshData" :editData="editData" />
    </div>
</template>

<script>
import Create from './Create.vue'
import Update from './Update.vue'
export default {
    components: {
        Create,
        Update,
    },
    data: function () {
        return {
            packages: {},
            editData: {},
            quarry: {
                per_page: 10,
                keyword: '',
                start_date: '',
                end_date: '',
            },
            metaData: {},
            businessAccessOptions: {},
            checkedIds: [],
            all_checked: false,
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadData();
    },
    methods: {
        loadData(page = 1) {
            axios.get(`/admin/package-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.packages = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        addNewData() {
            $("#createData").modal('show');
        },
        refreshData() {
            this.loadData();
        },
        editInfo(id) {
            axios.get(`/admin/package/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#updateData").modal('show');
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
                    axios.get(`/admin/package-bulk-delete?ids=${id}`).then((response) => {
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
            this.quarry.keyword = '';
            this.quarry.start_date = '';
            this.quarry.end_date = '';
            this.loadData();
        },
        allChecked() {
            if (this.checkedIds.length === this.packages.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.packages.map(pack => pack.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Package Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>
