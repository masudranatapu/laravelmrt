<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Asset</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addAsset()">
                                        <i class="fa fa-plus"></i>
                                        Add New Asset
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <select class="form-control" v-model="quarry.asset_category_id">
                                        <option value="">All</option>
                                        <option v-for="(category, index) in assetCategories" :value='category?.id'>
                                            {{ category?.asset_category_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Searching"
                                        v-model="quarry.keyword">
                                </div>
                                <div class="col-md-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadAsset()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearAssetCategories()">
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
                                                    <input type="checkbox" class="custom-control-input" id="allGroup">
                                                    <label for="allGroup" class="custom-control-label">
                                                        SL No
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Pay By</th>
                                            <th class="text-center">Note</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(asset, index) in assets">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'asset_' + asset?.id" :value='asset?.id'>
                                                    <label :for="'asset_' + asset?.id" class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ asset?.date }}
                                            </td>
                                            <td class="text-center">
                                                {{ asset?.category }}
                                            </td>
                                            <td class="text-center">
                                                {{ asset?.pay_by }}
                                            </td>
                                            <td class="text-center">
                                                {{ asset?.note }}
                                            </td>
                                            <td class="text-center">
                                                {{ asset?.amount }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editAsset(asset?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteAsset(asset?.id)">
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
        <CreateAsset @load-asset="refreshAsset" :assetCategories="assetCategories" />
        <UpdateAsset @load-asset="refreshAsset" :assetInfo="updateAssetInfo" />
    </div>
</template>

<script>
import CreateAsset from './CreateAsset.vue'
import UpdateAsset from './UpdateAsset.vue'
export default {
    components: {
        CreateAsset,
        UpdateAsset
    },
    data: function () {
        return {
            assets: {},
            assetCategories: {},
            assetInfo: {},
            quarry: {
                parpage: 20,
                keyword: '',
                asset_category_id: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadAsset();
        this.loadAssetCategory();
    },
    methods: {
        loadAsset() {
            axios.get("/assets-list", { params: this.quarry }).then((response) => {
                this.assets = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        loadAssetCategory() {
            axios.get("/load-asset-category").then((response) => {
                this.assetCategories = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        addAsset() {
            $("#createNewAsset").modal('show');
        },
        editAsset(id) {
            axios.get(`/assets/edit/${id}`).then((response) => {
                this.updateAssetCategoryInfo = response.data.data;
                $("#editAsset").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        refreshAsset() {
            this.loadAsset();
        },
        deleteAsset(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/assets/delete/${id}`).then((response) => {
                        this.isButtonDisabled = false;
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadAsset();
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
        clearAssetCategories() {
            this.quarry.parpage = 20;
            this.quarry.keyword = '';
            this.quarry.asset_category_id = '';
            this.loadAsset();
        },
    },
}
</script>

<style lang="scss" scoped></style>
