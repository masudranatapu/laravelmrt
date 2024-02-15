<template>
    <div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image" src="assets/img/users/user-1.png"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="javascript:;">
                                        {{ user?.name }}
                                    </a>
                                </div>
                                <div class="author-box-job">{{ user?.designation }}</div>
                            </div>
                            <div class="text-center">
                                <div class="author-box-description">
                                    <p>
                                        {{ user?.bio }}
                                    </p>
                                </div>
                                <div class="mb-2 mt-3">
                                    <div class="text-small font-weight-bold">Follow {{ user?.name }} On</div>
                                </div>
                                <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <div class="w-100 d-sm-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Birthday
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ user?.date_of_birth }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        <a :href="'tel:' + user.phone">{{ user?.phone }}</a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Email
                                    </span>
                                    <span class="float-right text-muted">
                                        <a :href="'mailto:' + user.email">{{ user?.email }}</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Skills</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Java</div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        <div class="progress" data-height="6">
                                            <div class="progress-bar bg-primary" data-width="70%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Web Design</div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        <div class="progress" data-height="6">
                                            <div class="progress-bar bg-warning" data-width="80%"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">Photoshop</div>
                                    </div>
                                    <div class="media-progressbar p-t-10">
                                        <div class="progress" data-height="6">
                                            <div class="progress-bar bg-green" data-width="48%"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="javascript:;" role="tab"
                                        @click="activeTab('profileUpdate')">
                                        Profile Update
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="javascript:;" role="tab"
                                        @click="activeTab('passwordUpdate')">
                                        Password
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ 'active': activeTab === 'profileUpdate' }"
                                        data-toggle="tab" href="#profileUpdate" role="tab"
                                        @click="changeTab('profileUpdate')">
                                        Profile Update
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ 'active': activeTab === 'passwordUpdate' }"
                                        data-toggle="tab" href="#passwordUpdate" role="tab"
                                        @click="changeTab('passwordUpdate')">
                                        Password
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane" :class="{ 'fade show active': activeTab === 'profileUpdate' }"
                                    id="profileUpdate">
                                    <ProfileUpdate :userinfo="user" />
                                </div>
                                <div class="tab-pane fade" :class="{ 'fade show active': activeTab === 'passwordUpdate' }"
                                    id="passwordUpdate">
                                    <PasswordUpdate :userinfo="user" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileUpdate from './ProfileUpdate.vue'
import PasswordUpdate from './PasswordUpdate.vue'
export default {
    components: {
        ProfileUpdate,
        PasswordUpdate
    },
    props: [],
    data: function () {
        return {
            password: {},
            user: {},
            isButtonDisabled: false,
            activeTab: 'profileUpdate',
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadUser();
    },
    methods: {
        loadUser() {
            axios.get("/profile-info").then((response) => {
                // console.log(response);
                this.user = response.data;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
        changeTab(tabId) {
            this.activeTab = tabId;
        },
    },
};
</script>

<style lang="scss" scoped></style>
