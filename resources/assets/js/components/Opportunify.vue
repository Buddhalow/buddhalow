<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>Opportunities</h3>
                            <table class="table table-striped table-responsive swedtable" v-if="objects.length > 0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th></th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(o, index) in objects">
                                        <td>{{moment(o.time).format('YY-MM-DD')}}</td>
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