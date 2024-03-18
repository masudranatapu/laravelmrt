<template>
    <div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Business List</h4>
                            <div class="card-header-form">
                                <div class="buttons">
                                    <a :href="'/admin/businesses/create'" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        Add New Business
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <div class="row">
                                <div class="form-group col-xl-2">
                                    <select class="form-control">
                                        <option value="">All</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-2">
                                    <select class="form-control" @change="loadBusinesse()">
                                        <option value="">Business Type</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-2">
                                    <select class="form-control" @change="loadBusinesse()">
                                        <option value="">Business Type</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control" placeholder="Start date"
                                            @change="loadBusinesse()">
                                        <span class="input-group-text bg-success">To</span>
                                        <input type="date" class="form-control" placeholder="End Date"
                                            @change="loadBusinesse()">
                                    </div>
                                </div>
                                <div class="form-group col-xl-2">
                                    <input type="text" class="form-control" placeholder="Search by business name"
                                        @change="loadBusinesse()">
                                </div>
                                <div class="form-group col-md-1">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-sm" @click="loadBusinesse()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm">
                                            Clear
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
                                            <th>Business Name</th>
                                            <th>Progress</th>
                                            <th>Members</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(business, index) in businesse">
                                            <td class="p-0 text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" :id="'checked_' + business?.id">
                                                    <label :for="'checked_' + business?.id"
                                                        class="custom-control-label">
                                                        # {{ index + 1 }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ business?.name }}</td>
                                            <td class="align-middle">
                                                <div class="progress" data-height="4" data-toggle="tooltip"
                                                    title="100%">
                                                    <div class="progress-bar bg-success" data-width="100"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <img alt="image" src="" class="rounded-circle" width="35" title="">
                                            </td>
                                            <td>2018-01-20</td>
                                            <td>
                                                <div class="badge badge-success">Completed</div>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Detail</a>
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
    </div>
</template>

<script>
export default {
    props: [],
    data: function () {
        return {
            businesses: {},
            main_url: window.location.origin + "/",
        };
    },
    beforeMount() {
        this.loadBusinesse();
    },
    methods: {
        loadBusinesse() {
            axios.get("/admin/businesses-list").then((response) => {
                console.log(response.data.data);
                this.businesses = response.data.data;
            }).catch((error) => {
                console.error("Error fetching profile information: ", error);
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>