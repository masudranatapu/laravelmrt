<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Area') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addArea()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Area') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-2">
                                    <select class="form-control" v-model="quarry.status">
                                        <option value="">{{ $t('All') }}</option>
                                        <option value="Active">{{ $t('Active') }}</option>
                                        <option value="Inactive">{{ $t('Inactive') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" :placeholder="$t('Search')"
                                        v-model="quarry.keyword">
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadData()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearLoadData()">
                                            {{ $t('Clear') }}
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $t('Action') }}
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;" @click="bulkDelete()">
                                                {{ $t('Delete') }}
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
                                                    <input type="checkbox" class="custom-control-input" id="allGroup"
                                                        @click="allChecked()" v-model="all_checked">
                                                    <label for="allGroup" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">{{ $t('Area Name') }}</th>
                                            <th class="text-center">{{ $t('Status') }}</th>
                                            <th class="text-center">{{ $t('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(area, index) in areas">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'area_' + area?.id" :value='area?.id' v-model="checkedIds">
                                                    <label :for="'area_' + area?.id" class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1
                                                        }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ area?.name }}</td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="area?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input" :checked="area?.status === 'Active'"
                                                        @change="areaStatusChange(area?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(area?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editArea(area?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteData(area?.id)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
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
        Update
    },
    data: function () {
        return {
            areas: {},
            editData: {},
            creators: {},
            quarry: {
                per_page: 10,
                keyword: '',
                status: '',
            },
            metaData: {},
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
            axios.get(`/area-list?page=${page}`, { params: this.quarry }).then((response) => {
                this.areas = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        addArea() {
            $("#createNewData").modal('show');
        },
        editArea(id) {
            axios.get(`/area/${id}/edit`).then((response) => {
                this.editData = response.data.data;
                $("#updateInfoData").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: this.$t('Error'),
                    message: this.$t(`Fetching data has error. Please try again.`),
                });
            });
        },
        refreshData() {
            this.loadData();
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
                    axios.get(`/area-type-bulk-delete?ids=${id}`).then((response) => {
                        this.isButtonDisabled = false;
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
        clearLoadData() {
            this.quarry.per_page = 10;
            this.quarry.keyword = '';
            this.quarry.status = '';
            this.loadData();
        },
        areaStatusChange(id) {
            axios.get(`/area/status/change/${id}`).then((response) => {
                this.isButtonDisabled = false;
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
        },
        allChecked() {
            if (this.checkedIds.length === this.areas.length) {
                this.checkedIds = [];
            } else {
                this.checkedIds = this.areas.map(area => area.id);
            }
        },
        bulkDelete() {
            if (this.checkedIds.length > 0) {
                this.deleteData(this.checkedIds);
            } else {
                this.$swal.fire('Area Not Select For This Action');
            }
        }
    },
}
</script>

<style lang="scss" scoped></style>
