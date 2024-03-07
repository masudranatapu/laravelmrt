<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Business</h4>
                        <div class="card-header-form">
                            <div class="buttons">
                                <a :href="'/admin/businesses'" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Business List
                                </a>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="createNewBusiness()">
                        <div class="card-header">

                        </div>
                        <div class="card-footer text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="cancelNewBusiness()">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary"
                                    :class="{ 'btn-progress': isButtonDisabled }" :disabled="isButtonDisabled">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            businesse: {
                name: '',
            },
            isButtonDisabled: false,
            main_url: window.location.origin + "/",
        };
    },
    methods: {
        createNewBusiness() {
            this.isButtonDisabled = true;
        },
        cancelNewBusiness() {
            this.isButtonDisabled = false;
            this.businesse.name = ''
        }
    },
};
</script>

<style lang="scss" scoped></style>