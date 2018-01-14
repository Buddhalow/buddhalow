<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Rental of your books last 28 days</h3>
                        <line-chart :data="cravings"></line-chart>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload sales from Elib
                    </div>
 
                    <div class="panel-body">
                        <file-upload ref="upload" accept=".xlsx,.csv" url="/api/sales/books" @progress="onProgress">
                            Upload file from elib
                        </file-upload>
                        <button class="button" @click="startUpload">Start upload</button>
                       
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
                cravings: {},
                progress: 0
            }
        },
        props: {
            start: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.start
                }
            },
            end: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.end
                }
            },
            group_by: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.group_by
                }
            }
        },
        mounted()
        {
            this.retrieveStats(moment().subtract(28, 'days').format(), moment().format())
        },
        methods: {
            retrieveStats(start, end) {
                console.log(start, end);
                axios.get(
                    '/api/stats/cravings?start=' + this.start + '&end=' +this.end + '&group_by=' + this.group_by   
                ).then((response) => {
                    var res = {};
                    var keys = this.group_by.split(/,/);
                    this.cravings = response.data.result.reduce((r, a) => {
                        
                       res[a[keys[0]]] = -a["qty"];
                       
                        return res;
                    });
                    console.log(this.cravings);
                })
            },
            onProgress(p) {
                console.log(p); 
                this.progress = p;
            },
            startUpload() {
                this.$refs.active = true;
            }
        }
    }
</script>
