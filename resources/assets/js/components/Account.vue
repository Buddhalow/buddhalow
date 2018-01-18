<template>
    <div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <div class="">
                                <table class="table table-responsive table-striped table-responsive swedtable ">
                                    <thead>
                                        <tr>
                                        <th colspan="5">{{ 'Karma account' | translate }} 0000-0 282 252-1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="">
                                            <td colspan="2">{{ 'Balance' | translate }}</td><td style="text-align: right; font-size: 10px">{{ account.balance | formatLongNumber}}</td>
                                            
                                        </tr>
                                        <tr v-if="account.reserved_debits > 0">
                                            <td colspan="2">{{ 'On hold' | translate }}</td><td style="text-align: right">{{ -account.reserved_debits | formatLongNumber}}</td>
                                        </tr>
                                        <tr v-if="account.future_deposits > 0">
                                            <td colspan="2">{{ 'Future deposit' | translate }}</td><td style="text-align: right"> {{ -account.future_deposits | formatLongNumber}}</td>
                                        </tr>
                                        <tr style="font-weight: bold; ">
                                            <td colspan="2">{{ 'Effective Harmony' | translate}}</td><td style="text-align: right; font-size: 10px">{{ account.available_amount | formatLongNumber}}</td>
                                            
                                        </tr>
                                       
                                    </tbody>
                                    <thead v-if="reservations.length > 0">
                                        <tr>
                                        <th colspan="5">{{ 'Reservations' | translate }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(item, i) in reservations">
                                            <td>{{item.time | formatDate}}</td>
                                            <td>{{ item.name }}</td><td style="text-align: right">
                                             {{ item.amount | formatNumber }}
                                             </td>
                                            
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                        <th colspan="5">{{ 'Latest transactions' | translate }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                    
                            
                                       <tr v-if="!!account.transactions" v-for="(item, i) in account.transactions.objects">
                                            <td>{{item.time | formatDate}}</td>
                                            <td>{{ item.name }}</td><td style="text-align: right">
                                                {{ item.amount | formatNumber }}
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
                account: {
                },
                transactions: [],
                reservations: []
            }
        },
        mounted() {
            this.load();
        },
        watch: {
            '$route' (_new, _old) {
                this.load();
            }
        },
        methods: {
            numeral(number) {
                return numeral(number)
            },
            formatNumber(number) {
                return numeral(-number).format('0,0.00').replace(/,/g, '•').replace(/\./g, ':') + ' QIH'
            },
            formatDate(date) {
                return moment(date).fromNow()
            },
            moment: moment,
            load() {
                axios.get('/api/ledgers/' + this.$route.params.id)
                    .then(response => {
                        this.account = response.data;
                        
                    });
            }
        }
    }
</script>