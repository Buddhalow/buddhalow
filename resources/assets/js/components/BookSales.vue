<template>
    <div class="page">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-heading">
                                <h3>Consumption stats for ''</h3>
                                <line-chart :data="sales"></line-chart>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
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
        </div>
    </div>
</template>
 
<script>
    import moment from 'moment';
    export default {
        data(){
            return {
                sales: {},
                progress: 0
            }
        },
        props: {
            start: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.start || moment(new Date(new Date().getTime() - 28 * 60 * 60 * 23 * 1000)).format('YYYY-MM-DD')
                }
            },
            end: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.end || moment().format('YYYY-MM-DD')
                }
            },
            group_by: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.query.group_by || 'date'
                }
            }
        },
        watch: {
            '$route' (to, from) {
              // react to route changes...
               this.retrieveStats(this.start, this.end)
            }
        },
        mounted()
        {
            this.retrieveSales(this.start, this.end)
        },
        methods: {
            retrieveSales(start, end) {
                console.log(start, end);
                axios.get(
                    '/api/stats?start=' + this.start + '&end=' +this.end + '&table=book_sales&group_by=' + this.group_by
                ).then((response) => {
                    var res = {};
                    var keys = this.group_by.split(/,/);
                    this.sales = response.data.result.reduce((r, a) => {
                        
                       res[a[keys[0]]] = a["qty"];
                        return res;
                    });
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
