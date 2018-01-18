<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>{{ 'Opportunities' | translate }}</h3>
                            <table class="table table-striped table-responsive swedtable" v-if="objects.length > 0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ 'Date' | translate }}</th>
                                        <th>{{ 'Name' | translate }}</th>
                                        <th>{{ 'Probability' | translate }}</th>
                                        <th>{{ 'Status' | translate }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(o, index) in objects">
                                        <td v-bind:class="['bg-dark', 'bg-' + Math.floor(o.status.code / 100) +'xx']" width="10pt">
                                            <i v-if=" Math.floor(o.status.code / 100) != 2" class="fa fa-warning"></i>
                                        </td>
                                        <td>{{o.time | formatDate}}</td>
                                        <td>{{o.name}}</td>
                                        <td><progress min="0" :value="o.probability" max="100"> {{o.probability}} %</progress></td>
                                        <td>{{o.status.name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
import moment from 'moment';
    export default {
        
        data(){
            return {
                objects: []
            }
        },
        watch: {
            '$route': function (o, old) {
                this.load() 
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            moment(str) {
                return moment(str)
            },
            load() {
                axios.get(
                    '/api/opportunities'    
                ).then(response => {
                    this.objects = response.data.data;
                })
            }
        }
    }
</script>