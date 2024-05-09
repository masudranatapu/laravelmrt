<template>
    <div>
        <div class="modal fade" id="viewInfoData" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">
                            {{ $t('View Account') }}
                        </h5>
                        <a href="javascript:;" @click="closeView()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <div class="modal-body author-box">
                        <div class="author-box">
                            <div class="author-box-center">
                                <div class="clearfix"></div>
                                <div class="author-box-job">
                                    {{ $t('Type') }}: {{ viewData?.type }}
                                </div>
                                <div class="author-box-job">
                                    {{ $t('Name') }}: {{ viewData?.mobile_bank_name }}
                                </div>
                                <div class="author-box-job">
                                    {{ $t('Number') }}: {{ viewData?.mobile_number }}
                                </div>
                                <div class="author-box-job">
                                    {{ $t('Service Charge') }}: {{ viewData?.mobile_number }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" @click="closeView()">
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
    props: ['viewData'],
    data: function () {
        return {
            mainUrl: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        closeView() {
            $("#viewInfoData").modal('hide');
        },
    },
}
</script>

<style lang="scss" scoped></style>
