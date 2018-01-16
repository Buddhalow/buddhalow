<template>
    <canvas ref="canvas" width="width" height="height"></canvas>
</template>

<script>
    import Chart from 'chart.js'
    export default {
         data(){
            return {
            }
        },
        props: ['data', 'width', 'height'],
        watch: {
            data (data, old) {
                
                var chart = this.$refs.canvas
                var ctx = chart.getContext('2d')
                new Chart(ctx, data)
            }
        },
        mounted() {
        }
    }
</script>