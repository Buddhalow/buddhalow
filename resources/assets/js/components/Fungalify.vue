<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>{{ 'Fungal infection' | translate }}</h3>
                            <table class="table table-striped table-responsive swedtable">
                                <thead>
                                    <tr>
                                        <th colspan="4">Infection account Darkcember 0000-0 2812-7</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right"></td>
                                        <td style="">Balance <span style="float: right;">{{infection.balance | formatNumber}} QIH</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="text-align: right"></td>
                                        <td style="">Debt <span style="float: right; font-weight: bold; font-size:10px">{{infection.balance | formatNumber}} QIH</span></td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody v-if="account.transactions.objects.length > 0">
                                    <tr  v-for="(o, index) in account.transactions.objects" style="opacity: 0.8">
                                        <td>{{o.time | formatTime}}</td>
                                        <td>{{o.name}}</td>
                                        <td style="text-align: right">{{o.amount | formatNumber}} QIH</td>
                                        <td style="text-align: right">{{o.balance | formatNumber}} QIH</td>
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
    import numeral from 'numeral'
    import moment from 'moment'
    export default {
        
        data(){
            return {
                infection: null,
                transactions: []
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
            moment(a) {
                return moment(a)
            },
            load() {
                axios.get(
                    '/api/infections/darkcember'    
                ).then(response => {
                    this.infection = response.data.infection;
                    this.transactions = response.data.transactions;
                })
            }
        }
    }
</script>