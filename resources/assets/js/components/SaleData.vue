<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload sale data
                    </div>
 
                    <div class="panel-body">
                         <buddhalow-fileupload target="/api/sales/books"></buddhalow-fileupload>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</template>
 
<script>
    export default {
        data(){
            return {}
        },
        mounted()
        {
 
        },
        methods: {}
    }
</script>
