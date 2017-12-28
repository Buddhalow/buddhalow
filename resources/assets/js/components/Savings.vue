<template>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Savings</div>
                        <div class="panel-body">
                            <a href="/dashboard/savings/create" class="btn btn-success btn-sm" title="Add New Saving">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
    
                        
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr><td>Planned acumulated savings</td><td style="text-align: right; opacity: 0.5">~{{ formatNumber(escalation_point)}}</td></tr>
                                        <tr><td>Lost savings</td><td style="text-align: right">-{{ formatNumber(escalation_point - (total + reserved))}}</td></tr>
                                    <tr>
                                        <td>Saved</td><td style="text-align: right">{{ formatNumber(total + 1000000).substr(1)}}</td>
                                    </tr>
                                    <tr v-if="reserved > 0">
                                        <td>Not yet deposited to savings</td><td style="text-align: right">-{{ formatNumber(reserved + 1000000).substr(1)}}</td></tr>
                                    
                                    <tr style="font-weight: bold; ">
                                        <td>Balance</td><td style="text-align: right; font-size: 9.8px !important;">{{ formatNumber((total - reserved) + 1000000).substr(1)}}</td></tr>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Reservations</div>
                        <div class="panel-body">
                            <table class="table table-borderless">
                                <tbody>
                                    
                                    <tr v-for="(item, i) in reservations">
                                        <td>{{formatDate(item.time)}}</td>
                                        <td>{{ item.name }}</td><td style="text-align: right">
                                         {{ formatNumber(item.amount) }}
                                         </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Recent transactions</div>
                        <div class="panel-body">
                            <a href="/dashboard/savings/create" class="btn btn-success btn-sm" title="Add New Saving">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                       <tr>
                                           <td></td>
                                           <td colspan="3">Latest transactions</td>
                                       </tr>
                                    
                            
                                       <tr v-for="(item, i) in transactions">
                                            <td>{{formatDate(item.time)}}</td>
                                            <td>{{ item.name }}</td><td style="text-align: right">
                                                {{ numeral(item.amount).format('0,0') }}
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
            formatNumber(number) {
                return numeral(number).format('0,0.00').replace(',', ' ').replace('.', ',')
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