<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>Threats</h3>
                            <table class="table table-bordered table-striped table-responsive" v-if="objects.length > 0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(o, index) in objects">
                                        <td>{{o.name}}</td>
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
    export default {
        data(){
            return {
                objects: []
            }
        },
        watch: {
            '$route': function (o, old) {
                this.load();
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                axios.get(
                    '/api/threats'    
                ).then((result) => {
                    this.objects = result.data.data;
                    
                })
            }
        }
    }
</script>