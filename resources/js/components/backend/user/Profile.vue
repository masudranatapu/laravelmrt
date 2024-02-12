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
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#about" role="tab">
                                        About
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                        Setting
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel">
                                    <form method="post" class="needs-validation">
                                        <div class="card-header">
                                            <h4>Edit Profile</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" value="John">
                                                    <div class="invalid-feedback">
                                                        Please fill in the first name
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" value="Deo">
                                                    <div class="invalid-feedback">
                                                        Please fill in the last name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-7 col-12">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" value="test@example.com">
                                                    <div class="invalid-feedback">
                                                        Please fill in the email
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 col-12">
                                                    <label>Phone</label>
                                                    <input type="tel" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Bio</label>
                                                    <textarea class="form-control summernote-simple"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mb-0 col-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="remember" class="custom-control-input"
                                                            id="newsletter">
                                                        <label class="custom-control-label" for="newsletter">Subscribe to
                                                            newsletter</label>
                                                        <div class="text-muted form-text">
                                                            You will get new information about products, offers and
                                                            promotions
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="button" class="btn btn-warning mr-2">
                                                Clear
                                            </button>
                                            <button type="button" class="btn btn-primary">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel">
                                    <form @submit.prevent="updatePassword()">
                                        <div class="card-header">
                                            <h4>Update Password</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Old Password</label>
                                                    <input type="text" v-model="password.old_password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>New Password</label>
                                                    <input type="text" v-model="password.password" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Confirm Password</label>
                                                    <input type="text" v-model="password.password_confirmation"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="button" class="btn btn-warning mr-2">
                                                Clear
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Save Changes
                                            </button>
                                        </div>
                                    </form>
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
export default {
    props: [],
    data: function () {
        return {
            password: {},
            user: {},
            message: "",
            errors: {},
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
        updatePassword() {
            axios.post(`/password-update/${this.user.id}`, this.password).then((response) => {
                console.log([response]);
            }).catch((error) => {
                console.log([error]);
            });
        }
    },
};
</script>

<style lang="scss" scoped></style>
