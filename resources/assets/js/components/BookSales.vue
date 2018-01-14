<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Rental of your books last 28 days</h3>
                        <line-chart :data="salePeriod"></line-chart>
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
                salePeriod: {},
                progress: 0
            }
        },
        mounted()
        {
            this.retrieveSales(moment().subtract(28, 'days').format(), moment().format())
        },
        methods: {
            retrieveSales(start, end) {
                console.log(start, end);
                axios.get(
                    '/api/sales/books?start=' + start.split('T')[0] + '&end=' + end.split('T')[0]     
                ).then((response) => {
                    var r = {};
                    this.salePeriod = response.data.sales.reduce((r, a) => {
                        r[a.date] = r[a.date] || 0;
                        r[a.date] = a.total;
                        return r;
                    });
                    delete this.salePeriod['date'];
                    delete this.salePeriod['total'];
                    console.log(this.salePeriod);
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
