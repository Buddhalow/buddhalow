<template>
    <div>
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="">
                                <h1>{{ 'Viewing challenge!' | translate}}</h1>
                                <vue-chart :data="progress"></vue-chart>
                                <div class="spinner" v-if="!progress"></div>
                            </div>
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
                progress: null
            }
        }, 
        props: {
            id: {
                type: String,
                required: false,
                default: function () {
                    return this.$route.params.id
                }
            },
        },
        watch: {
            '$route'() {
                this.load()
            }
        },
        mounted()
        {
            this.load()
        },
        methods: {
            load() {
                axios.get('/api/challenges/' + this.$route.params.id).then((response) => {
                    this.progress = {
                        type: 'line',
                        data: {
                            labels: response.data.dates.map(o => o.date),
                            datasets: [{
                                label: 'Progress',
                                data: response.data.dates.map(o => o.progress),
                                backgroundColor: ['#0077ff55']
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                        suggestedMax: 100,
                                        beginAtZero: false   // minimum value will be 0.
                                    }
                                }]
                            }
                        }
                    }
                })
            }
        }
    }
</script>
 