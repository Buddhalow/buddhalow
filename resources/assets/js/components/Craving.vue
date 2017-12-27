<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                        My Craving
                    </div>
 
                    <div class="panel-body">
                        <button @click="initAddCraving()" class="btn btn-primary  pull-right">
                            + Add New Craving
                        </button>
                        <table class="table table-bordered table-striped table-responsive" v-if="cravings.length > 0">
                            <thead>
                                <tr>
                                    <th>time</th><th>status</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(craving, index) in cravings">
                                    <td>{{craving.time}}</td><td>{{craving.status}}</td><td><div class="btn-group"><button @click="initUpdate(index)" class="btn btn-success">Edit</button><button @click="deleteCraving(index)" class="btn btn-danger">Delete</button></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_craving_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Craving</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
    <label for="time" class="col-md-4 control-label">{{ 'Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="time" type="date" v-model="craving.time" >
        <p v-if="error" class="help-block">:message</p>
    </div>
</div><div class="form-group">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="number" v-model="craving.status" >
        <p v-if="error" class="help-block">:message</p>
    </div>
</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="saveCraving" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
 
    </div>
</template>
 
<script>
    export default {
        data(){
            return {
                craving: {
                    time: '',status: ''
                },
                errors: [],
                cravings: []
            }
        },
        mounted() {
            this.readCravings();
        },
        methods: {
            initAddCraving()
            {
                this.errors = [];
                $("#edit_craving_model").modal("show");
            },
            saveCraving()
            {
                var savePromise = null;
              
                var id = this.craving != null && this.craving.id != null ? this.craving.id : null;
                if (id) {
                    savePromise = axios.put('/api/cravings/' + id, this.craving);
                    debugger;
                } else {
                    savePromise = axios.post('/api/cravings', this.craving);
                }
                savePromise.then(response => {
     
                    this.reset();

                    $("#edit_craving_model").modal("hide");

                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
                
            },
            readCravings()
            {
                axios.get('/api/cravings')
                    .then(response => {
                        this.cravings = response.data.data;
                    });
            },
            deleteCraving(index)
            {
                let conf = confirm("Do you ready want to delete this craving?");
                if (conf === true) {

                    axios.delete('/cravings/' + this.cravings[index].id)
                        .then(response => {

                            this.cravings.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            },
            initUpdate(index)
            {
                this.errors = [];
                $('#edit_craving_model').modal("show");
                this.craving = this.cravings[index];
            },
            reset()
            {
                this.craving.time = '';this.craving.status = '';
            }
        }
    }
</script>