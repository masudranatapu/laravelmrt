<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $t('Asset Category') }}</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <button type="button" class="btn btn-primary" @click="addAssetCategory()">
                                        <i class="fa fa-plus"></i>
                                        {{ $t('Add New Asset Category') }}
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
                                    <input type="text" class="form-control" placeholder="Searching"
                                        v-model="quarry.keyword">
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success" @click="loadAssetCategories()">
                                            {{ $t('Search') }}
                                        </button>
                                        <button type="button" class="btn btn-warning" @click="clearAssetCategories()">
                                            {{ $t('Clear') }}
                                        </button>
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $t('Action') }}
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="javascript:;">
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
                                                    <input type="checkbox" class="custom-control-input" id="allGroup">
                                                    <label for="allGroup" class="custom-control-label">
                                                        {{ $t('SL No') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">{{ $t('Asset Category Name') }}</th>
                                            <th class="text-center">{{ $t('Status') }}</th>
                                            <th class="text-center">{{ $t('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(assetCategory, index) in assetCategories">
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'asset_category_' + assetCategory?.id"
                                                        :value='assetCategory?.id'>
                                                    <label :for="'asset_category_' + assetCategory?.id"
                                                        class="custom-control-label">
                                                        {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ assetCategory?.asset_category_name }}
                                            </td>
                                            <td class="text-center">
                                                <label class="custom-switch mt-2" :title="assetCategory?.status">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input"
                                                        :checked="assetCategory?.status === 'Active'"
                                                        @change="assetCategoryStatusChange(assetCategory?.id)">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">
                                                        {{ $t(assetCategory?.status) }}
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="btn btn-icon btn-primary btn-sm" title="Edit"
                                                        @click="editAssetCategory(assetCategory?.id)">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                        title="Delete" @click="deleteAssetCategory(assetCategory?.id)">
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
        <CreateAssetCategory @load-asset-category="refreshAssetCategory" />
        <UpdateAssetCategory @load-asset-category="refreshAssetCategory" :assetCategoryInfo="updateAssetCategoryInfo" />
    </div>
</template>

<script>
import CreateAssetCategory from './CreateAssetCategory.vue'
import UpdateAssetCategory from './UpdateAssetCategory.vue'
export default {
    components: {
        CreateAssetCategory,
        UpdateAssetCategory
    },
    data: function () {
        return {
            assetCategories: {},
            updateAssetCategoryInfo: {},
            creators: {},
            quarry: {
                parpage: 20,
                keyword: '',
                status: '',
            },
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadAssetCategories();
    },
    methods: {
        loadAssetCategories() {
            axios.get("/asset-category-list", { params: this.quarry }).then((response) => {
                this.assetCategories = response.data.data;
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        addAssetCategory() {
            $("#createNewAssetCategory").modal('show');
        },
        editAssetCategory(id) {
            axios.get(`/asset-category/edit/${id}`).then((response) => {
                this.updateAssetCategoryInfo = response.data.data;
                $("#editAssetCategory").modal('show');
            }).catch((error) => {
                this.$iziToast.error({
                    title: 'Error',
                    message: `Error fetching data for ${error}`,
                });
            });
        },
        refreshAssetCategory() {
            this.loadAssetCategories();
        },
        deleteAssetCategory(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`/asset-category/delete/${id}`).then((response) => {
                        this.isButtonDisabled = false;
                        if (response.data.status == true) {
                            this.$iziToast.success({
                                title: 'Success',
                                message: response.data.message,
                            });
                            this.loadAssetCategories();
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
            this.quarry.status = '';
            this.loadAssetCategories();
        },
        assetCategoryStatusChange(id) {
            axios.get(`/asset-category/status/change/${id}`).then((response) => {
                this.isButtonDisabled = false;
                if (response.data.status == true) {
                    this.$iziToast.success({
                        title: 'Success',
                        message: response.data.message,
                    });
                    this.loadAssetCategories();
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
        }
    },
}
</script>

<style lang="scss" scoped></style>
