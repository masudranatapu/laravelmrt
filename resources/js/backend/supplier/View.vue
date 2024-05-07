<template>
    <div>
        <div class="modal fade" id="viewInfoDataModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('View Supplier') }}
                        </h5>
                        <a href="javascript:;" @click="closeViewData()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <div class="modal-body author-box">
                        <div class="author-box">
                            <div class="author-box-center">
                                <img alt="image" :src='viewInfoData?.image' class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name mt-2">
                                    <a href="javascript:;">
                                        {{ viewInfoData?.name }}
                                    </a>
                                </div>
                                <div class="author-box-job">
                                    {{ $t('Date') }}: {{ viewInfoData?.date }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" @click="closeViewData()">
                            {{ $t('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['viewInfoData'],
    data: function () {
        return {
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        closeViewData() {
            $("#viewInfoDataModal").modal('hide');
        },
    },
}
</script>

<style lang="scss" scoped></style>
