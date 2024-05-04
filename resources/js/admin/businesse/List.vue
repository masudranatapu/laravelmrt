<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Business List') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <a :href="'/admin/businesses/create'" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Business') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="form-group col-xl-2">
                                    <select class="form-control">
                                        <option value="">{{ $t('All') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-2">
                                    <select class="form-control" @change="loadBusinesse()">
                                        <option value="">{{ $t('Business Type') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-2">
                                    <select class="form-control" @change="loadBusinesse()">
                                        <option value="">{{ $t('Business Type') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control" placeholder="Start date"
                                            @change="loadBusinesse()">
                                        <span class="input-group-text bg-success">{{ $t('To') }}</span>
                                        <input type="date" class="form-control" placeholder="End Date"
                                            @change="loadBusinesse()">
                                    </div>
                                </div>
                                <div class="form-group col-xl-2">
                                    <input type="text" class="form-control" placeholder="Search by business name"
                                        @change="loadBusinesse()">
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadBusinesse()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearSearch()">
                                            {{ $t('Clear') }}
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
                                                    <label for="checkbox-all" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            <th>{{ $t('Business Name') }}</th>
                                            <th>{{ $t('Progress') }}</th>
                                            <th>{{ $t('Members') }}</th>
                                            <th>{{ $t('Due Date') }}</th>
                                            <th>{{ $t('Status') }}</th>
                                            <th>{{ $t('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(business, index) in businesses">
                                            <td class="p-0 text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'checked_' + business?.id">
                                                    <label :for="'checked_' + business?.id"
                                                        class="custom-control-label">
                                                        {{ (metaData.current_page - 1) * metaData.per_page + index + 1
                                                        }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ business?.name }}
                                            </td>
                                            <td>
                                                <a :href="'mailto:' + business?.email">{{ business?.email }}</a>
                                            </td>
                                            <td>
                                                <a :href="'tel:' + business?.phone">{{ business?.phone }}</a>
                                            </td>
                                            <td>2018-01-20</td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline mr-2">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        :class="getStatusButtonClass(business?.status)"
                                                        id="dropdownMenuButton3" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ business?.status }}
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(business?.id, 'Active')" type="button"
                                                            v-if="business?.status === 'Inactive' || business?.status === 'Pending' || business?.status === 'Blocked'">
                                                            {{ $t('Make Active') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(business?.id, 'Inactive')"
                                                            type="button"
                                                            v-if="business?.status === 'Active' || business?.status === 'Pending'">
                                                            {{ $t('Make Inactive') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(business?.id, 'Blocked')" type="button"
                                                            v-if="business?.status === 'Active' || business?.status === 'Pending'">
                                                            {{ $t('Block User') }}
                                                        </button>
                                                        <button class="dropdown-item"
                                                            @click="changeStatus(business?.id, 'Pending')" type="button"
                                                            v-if="business?.status === 'Active'">
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
                                                            @click="viewInfo(business?.id)">
                                                            <i class="fa fa-eye"></i>
                                                            {{ $t('View') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon"
                                                            :href="'/admin/businesses/' + business?.id + '/edit'">
                                                            <i class="fas fa-pen"></i>
                                                            {{ $t('Edit') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="javascript:;"
                                                            @click="deleteData(business?.id)">
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
                                        Showing {{ metaData.from }} to {{ metaData.to }} of {{ metaData.total }} entries
                                    </span>
                                </div>
                                <div>
                                    <Pagination :data="metaData" @pagination-change-page="loadBusinesse" :limit="5">
                                    </Pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            businesses: {},
            metaData: {},
            quarry: {
                per_page: 10,
                keyword: '',
                start_date: '',
                end_date: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadBusinesse();
    },
    methods: {
        loadBusinesse(page = 1) {
            axios.get(`/admin/businesses-list?page=${page}`).then((response) => {
                this.businesses = response.data.data;
                this.metaData = response.data.meta;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        getStatusButtonClass(status) {
            return {
                'btn-info': status === 'Pending',
                'btn-success': status === 'Active',
                'btn-secondary': status === 'Inactive',
                'btn-danger': status === 'Blocked'
            };
        },
        changeStatus(id, changeStatus) {
            axios.get(`/admin/businesses-status-change/${id}?status=${changeStatus}`).then((response) => {
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: this.$t('Success'),
                        message: this.$t(response.data.message),
                    });
                    this.loadBusinesse();
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
        clearSearch() {
            this.quarry.per_page = 10;
            this.quarry.keyword = '';
            this.quarry.start_date = '';
            this.quarry.end_date = '';

            this.loadData();
        },
    },
};
</script>

<style lang="scss" scoped></style>
