<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <h3>Savify</h3>
                                <div class="">
                                <table class="table table-responsive table-striped table-responsive swedtable ">
                                    <thead>
                                        <tr>
                                        <th colspan="5">Savings account 0000-0 282 252-1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="2">Planned acumulated savings</td><td style="text-align: right; opacity: 0.5">~ {{ formatNumber(escalation_point)}}</td></tr>
                                        <tr><td colspan="2">Lost savings</td><td style="text-align: right">- {{ formatNumber(escalation_point - (total + reserved))}}</td></tr>
                                        <tr>
                                            <td colspan="2">Saved</td><td style="text-align: right">{{ formatNumber(total + 1000000).substr(1)}}</td>
                                        </tr>
                                        <tr v-if="reserved > 0">
                                            <td colspan="2">Not yet deposited to savings</td><td style="text-align: right">- {{ formatNumber(reserved + 1000000).substr(1)}}</td></tr>
                                        
                                        <tr style="font-weight: bold; ">
                                            <td colspan="2">Balance</td><td style="text-align: right; font-size: 10px">{{ formatNumber((total - reserved) + 1000000).substr(1)}}</td>
                                            
                                        </tr>
                                       
                                    </tbody>
                                    <thead v-if="reservations.length > 0">
                                        <tr>
                                        <th colspan="5">Reservations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(item, i) in reservations">
                                            <td>{{formatDate(item.time)}}</td>
                                            <td>{{ item.name }}</td><td style="text-align: right">
                                             {{ formatNumber(item.amount) }}
                                             </td>
                                            
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                        <th colspan="5">Latest transactions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                    
                            
                                       <tr v-for="(item, i) in transactions">
                                            <td>{{moment(item.time).format('YY-MM-DD')}}</td>
                                            <td>{{ item.name }}</td><td style="text-align: right">
                                                {{ formatNumber(item.amount + 1000000) }}
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                transactions: [],
                reservations: [],
                reserved: 0,
                escalation_point: 133500,
                total: 0
            }
        },
        mounted() {
            this.readSavings();
        },
        methods: {
            numeral(number) {
                return numeral(number)
            },
            formatNumber(number) {
                return numeral(number).format('0,0.00').replace(/,/g, ' ').replace(/\./g, ',')
            },
            formatDate(date) {
                return moment(date).fromNow()
            },
            moment: moment,
            readSavings()
            {
                axios.get('/api/savings')
                    .then(response => {
                        this.transactions = response.data.transactions;
                        this.reservations = response.data.reservations;
                        this.reserved = response.data.reserved;
                        this.total = response.data.total;
                    });
            }
        }
    }
</script>