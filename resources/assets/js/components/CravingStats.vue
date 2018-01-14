<template>
    <div>
        <div class="section section-white">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-heading">
                                <h3>Cravings last 28 days</h3>
                                <line-chart :data="cravings"></line-chart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-alternative">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="">
                            <vue-circle
                            :progress="character"
                            :size="300"
                            :reverse="false"
                            line-cap="round"
                            :fill="fill"
                            empty-fill="rgba(0, 0, 0, .1)"
                            :animation-start-value="0.0"
                            :start-angle="0"
                            insert-mode="append"
                            :thickness="5"
                            :show-percent="true"
                            >
                                  <p>Character</p>
                          </vue-circle>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <vue-circle
                            :progress="character"
                            :size="300"
                            :reverse="false"
                            line-cap="round"
                            :fill="fill"
                            empty-fill="rgba(0, 0, 0, .1)"
                            :animation-start-value="0.0"
                            :start-angle="0"
                            insert-mode="append"
                            :thickness="5"
                            :show-percent="true"
                            >
                                <p>Healthy habits</p>
                            </vue-circle>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="">
                            <vue-circle
                            :progress="character"
                            :size="300"
                            :reverse="false"
                            line-cap="round"
                            :fill="fill"
                            empty-fill="rgba(0, 0, 0, .1)"
                            :animation-start-value="0.0"
                            :start-angle="0"
                            insert-mode="append"
                            :thickness="5"
                            :show-percent="true"
                            >
                                <p>Healthy habits</p>
                            </vue-circle>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <div class="panel-heading">
                                <h3>Top weekdays</h3>
                                <line-chart :data="weedays"></line-chart>
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
                cravings: {},
                statuses: {},
                actions: {},
                foods: {},
                character: 2,
                weekdays: {},
                progress: 0,
                weekdaysHandler: new Vue()
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
            this.retrieveStats(this.start, this.end)
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
                        
                       res[a[keys[0]]] = a["qty"];
                        return res;
                    });
                    console.log(this.cravings);
                })
                axios.get(
                    '/api/stats/cravings?start=' + this.start + '&end=' +this.end + '&group_by=weekday,date'
                ).then((response) => {
                    var res = {};
                    var keys = this.group_by.split(/,/);
                    this.weekdays = response.data.result.reduce((r, a) => {
                        
                       res[a['weekday']] = a["qty"];
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
