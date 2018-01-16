<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>Fungal infection</h3>
                            <table class="table table-striped table-responsive" >
                                <thead>
                                    <tr>
                                        <th colspan="2">Balance</th>
                                        <th style="text-align: right">{{formatNumber(infection.balance)}} QIH</th>
                                        <th style="text-align: right">{{formatNumber(infection.balance)}} QIH</th>
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
                                <tbody v-if="transactions.length > 0">
                                    <tr  v-for="(o, index) in transactions">
                                        <td>{{o.time}}</td>
                                        <td>{{o.name}}</td>
                                        <td style="text-align: right">{{formatNumber(o.amount)}} QIH</td>
                                        <td style="text-align: right">{{formatNumber(o.balance)}} QIH</td>
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
            
            formatNumber(str) {
                return numeral(str).format('0,0.00').replace(/,/g, '•').replace(/\./g, ':')
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