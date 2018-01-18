<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table table-bordered table-striped table-responsive swedtable" v-if="roamings.length > 0">
                                <thead>
                                    <tr>
                                        <th colspan="2">{{ 'Aqtivity log' | translate }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(roaming, index) in roamings">
                                        <td v-bind:class="['bg-dark', 'bg-' + Math.floor(roaming.status / 100) +'xx']" width="10pt">
                                            <i v-if=" Math.floor(roaming.status / 100) != 2" class="fa fa-warning"></i>
                                        </td>
                                        <td colspan="4">
                                            <span style="float: left">{{roaming.aqtivities[0].sport}}, {{roaming.aqtivities[0].facility}}</span>
                                            <span style="float: right">{{roaming.time | fromNow}}</span>
                                            <br>
                                            <details>
                                                <summary>{{ 'Details' | translate }}</summary>
                                                <table width="100%">
                                                    <tbody>
                                                    <tr v-for="aqtivity in roaming.aqtivities">
                                                        <td>{{aqtivity.sport | translate}}</td>
                                                        <td>{{aqtivity.facility | translate}}</td>
                                                        <td>{{aqtivity.dimension | translate}}</td>
                                                    </tr>
                                                    </tbody>
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
        </div>
 
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_roaming_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ 'Roaming' | translate }}</h4>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ 'Close' | translate }}</button>
                        <button type="button" @click="saveRoaming" class="btn btn-primary">{{ 'Submit' | translate }}</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
 
    </div>
</template>
 
<script>
    import moment from 'moment'
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
            this.load();
        },
        watch: {
            '$route'() {
                this.load()
            }
        },
        methods: {
            moment(time) {
                return moment(time)
            },
            load()
            {
                axios.get('/api/roamings')
                    .then(response => {
                        
                        this.roamings = response.data.roamings.data;
                    });
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