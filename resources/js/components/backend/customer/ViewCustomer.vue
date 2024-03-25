<template>
    <div>
        <div class="modal fade" id="viewCustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">
                            {{ $t('View Customer') }}
                        </h5>
                        <a href="javascript:;" @click="closeViewCustomer()" class="btn btn-icon btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <div class="modal-body author-box">
                        <div class="author-box">
                            <div class="author-box-center">
                                <img alt="image" :src='customerView?.image' class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name mt-2">
                                    <a href="javascript:;">
                                        {{ customerView?.name }}
                                    </a>
                                </div>
                                <div class="author-box-job">
                                    {{ $t('Date') }}: {{ customerView?.date }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" @click="closeViewCustomer()">
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
    props: ['customerView'],
    data: function () {
        return {
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {

    },
    methods: {
        closeViewCustomer() {
            $("#viewCustomer").modal('hide');
        },
    },
}
</script>

<style lang="scss" scoped></style>
