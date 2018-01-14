<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                       Aqtivities
                    </div>
 
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="roamings.length > 0">
                            <thead>
                                <tr>
                                    <th>time</th><th>status</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(roaming, index) in roamings">
                                    <td colspan="4">
                                        <details>
                                            <summary>roaming.time</summary>
                                            <table width="100%">
                                                <tr v-for="aqtivity in roaming.aqtivities">
                                                    <td>{{aqtivity.sport_id}}</td>
                                                    <td>{{aqtivity.facility_id}}</td>
                                                    <td>{{aqtivity.dimension_id}}</td>
                                                </tr>
                                            </table>
                                        </details>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_roaming_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Roaming</h4>
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
        <input class="form-control" name="time" type="date" v-model="roaming.time" >
        <p v-if="error" class="help-block">:message</p>
    </div>
</div><div class="form-group">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="status" type="number" v-model="roaming.status" >
        <p v-if="error" class="help-block">:message</p>
    </div>
</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="saveRoaming" class="btn btn-primary">Submit</button>
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
                roaming: {
                    time: '',status: ''
                },
                errors: [],
                roamings: []
            }
        },
        mounted() {
            this.readRoamings();
        },
        methods: {
            initAddRoaming()
            {
                this.errors = [];
                $("#edit_roaming_model").modal("show");
            },
            saveRoaming()
            {
                var savePromise = null;
              
                var id = this.roaming != null && this.roaming.id != null ? this.roaming.id : null;
                if (id) {
                    savePromise = axios.put('/api/roamings/' + id, this.roaming);
                  
                  
                } else {
                    savePromise = axios.post('/api/roamings', this.roaming);
                }
                savePromise.then(response => {
     
                    this.reset();

                    $("#edit_roaming_model").modal("hide");

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
            readRoamings()
            {
                axios.get('/api/roamings')
                    .then(response => {
                        this.roamings = response.data.roamings.data;
                    });
            },
            deleteRoaming(index)
            {
                let conf = confirm("Do you ready want to delete this roaming?");
                if (conf === true) {

                    axios.delete('/roamings/' + this.roamings[index].id)
                        .then(response => {

                            this.roamings.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            },
            initUpdate(index)
            {
                this.errors = [];
                $('#edit_roaming_model').modal("show");
                this.roaming = this.roamings[index];
            },
            reset()
            {
                this.roaming.time = '';this.roaming.status = '';
            }
        }
    }
</script>