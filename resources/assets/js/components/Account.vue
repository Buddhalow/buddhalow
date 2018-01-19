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
                                        <th colspan="5">{{ account.name }} 0000-0 282 252-1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="">
                                            <td colspan="2">{{ 'Balance' | translate }}</td><td style="text-align: right;">{{ account.balance | formatLongNumber}}</td>
                                            
                                        </tr>
                                        <tr v-if="account.reserved_debit > 0">
                                            <td colspan="2">{{ 'On hold' | translate }}</td><td style="text-align: right">-{{ account.reserved_debit | formatLongNumber}}</td>
                                        </tr>
                                        <tr v-if="account.future_deposit > 0">
                                            <td colspan="2">{{ 'Future deposit' | translate }}</td><td style="text-align: right"> -{{ account.future_deposit | formatLongNumber}}</td>
                                        </tr>
                                        <tr style="font-weight: bold; ">
                                            <td colspan="2">{{ 'Effective Harmony' | translate}}</td><td style="text-align: right; ">{{ account.available_amount | formatLongNumber}}</td>
                                            
                                        </tr>
                                       
                                    </tbody>
                                    <thead v-if="account.reserved_debits.length > 0">
                                        <tr>
                                        <th colspan="5">{{ 'Reservations' | translate }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(item, i) in account.reserved_debits">
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
                                     
                                    
                            
                                       <tr v-if="account.transactions != null" v-for="(item, i) in account.transactions.objects">
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
                    reserved_debit:0,
                    future_deposit:0,
                    reserved_debits: [],
                    future_deposits: []
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