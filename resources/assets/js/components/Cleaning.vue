<template>
    <div>
        <div class="section section-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="panel-heading">
                                <h3>{{ 'Room integrity history' | translate }}</h3>
                                <line-chart :library="{fill:true}" :data="stats"></line-chart>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div v-for="(room, i) in rooms" style="text-align: center">
                        <div class="col-md-4">
                           <vue-circle
                            :progress="100+((room.balance)/room.harmony_duration)*100"
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
                          <p>Clean</p>
                           <div v-if="room.balance < -0.5">
                            <i class="fa fa-warning"></i>
                            <h3>{{ 'Needs cleaning' | translate }}</h3>
                            </div>
                          </vue-circle>
                        <h3>{{room.name}}</h3>
                       
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
                rooms: {},
                snapshots: [],
                stats:[]
            }
        },
        props: {
            room: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.params.room || 'all'
                }
            },
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
                    '/api/rooms/all/snapshots?start=' + this.start + '&end=' +this.end + '&group_by=' + this.group_by   
                ).then((response) => {
                    var res = {};
                    var keys = this.group_by.split(/,/);
                    this.rooms = response.data.rooms
                    var data = []
                    for (let room of this.rooms) {
                        var rd = ({
                            name: room.name,
                            data: {},
                            fill: true
                        })
                        for (let snapshot of room.snapshots) {
                            rd.data[snapshot.date] = snapshot.balance
                        }
                        data.push(rd)
                    }
                    this.stats = data
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
