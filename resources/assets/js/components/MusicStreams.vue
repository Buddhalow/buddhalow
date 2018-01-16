<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-heading">
                                <h3>Streams</h3>
                                <vue-chart :data="streams"></vue-chart>
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
                streams: {},
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
               this.retrieveStats(this.start, this.end)
            }
        },
        mounted()
        {
            this.retrieveSales(this.start, this.end)
        },
        methods: {
            retrieveSales(start, end) {
                var colors = ['#1e88e533', '#c0ca3333', '#fb8c0033']
                axios.get(
                    '/api/streams?start=' + this.start + '&end=' +this.end + ''
                ).then((response) => {
                    var props = ['streams', 'followers', 'listeners'];
                    this.streams = {
                        type: 'line',
                        data: {
                            labels: response.data.streams.map(o => o.time),
                            datasets: props.map(
                                (m, i) => {
                                    return {
                                        label: m,
                                        xAxisID: m,
                                        backgroundColor: [colors[i]],
                                        borderColor: [colors[i]],
                                        data: response.data.streams.map((o) => o[m])
                                    };
                                }
                            )
                        },
                        options: {
                            scales: {
                                xAxes: props.map(o => {
                                    return {
                                        id: o,
                                        type: 'category'
                                        
                                    }
                                })
                            }
                        }
                    }   
                });
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
