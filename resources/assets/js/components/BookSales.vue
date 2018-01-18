<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-heading">
                                <h3>{{ 'Consumption stats for' | translate }} ''</h3>
                                <vue-chart :data="sales"></vue-chart>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <div class="panel-heading">
                                <h3>{{ 'Top 10 libraries / stores' | translate }}</h3>
                                <bar-chart :data="stores" :stacked="true"></bar-chart>
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
            isbn: {
                type: String,
                required: false,
                default: ''
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
               this.retrieveStats(this.start, this.end, this.group_by)
            }
        },
        mounted()
        {
            this.retrieveSales(this.start, this.end, this.group_by)
        },
        methods: {
            retrieveSales(start, end, group_by) {
                axios.get(
                    '/api/stats?start=' + start + '&end=' + end + '&table=book_sales&group_by=' + group_by + '&isbn=' + this.isbn + '&aggregate=store,format'
                ).then((response) => {
                    var keys = this.group_by.split(/,/);
                    
                    var r = {};
                    this.sales = {
                        type: 'line',
                        data: {
                            
                            labels: response.data.result.map(o => {
                                return o.date
                            }),
                            datasets: [
                                {
                                    label: 'Sales',
                                    backgroundColor: ['#0077ff33'],
                                    data: response.data.result.map(o => {
                                      
                                        return o.qty
                                    })
                                }
                            ]   
                        },
                        options: {
                            scales: {
                                xAxes: {
                                    id: 'time',
                                    type: 'category'
                                        
                                    
                                }
                            }
                        }
                    };
                        
                    var r = {};
                    this.stores = response.data.aggregation.stores.slice(0, 10).reduce((t, a) => {
                       
                        if (a['count'] > 0)
                        r[a['name']] = a['count']
                        return r
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
