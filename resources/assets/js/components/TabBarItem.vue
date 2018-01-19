<template>
        <router-link class="tabbar-item" :to="to">
            <i v-bind:class="['fa', 'fa-' + this.icon]"></i>
            <span>{{label}}</span>
        </router-link>
    
</template>
<style scoped>
.tabbar-item {;
}
.router-link-active {
}
    .tabbar-item {
            text-align: center;
            padding: 2pt 8pt;
    }
    i {
        font-size: 14pt;
    }
    i, span {
        display: block;
    }
</style>
<script>
    export default {
        props: {
            icon: {
                default: '',
                required: true
            },
            label: {
                default: '',
                required: true
            },
            to: {
                required: true
            }
        }
    }
</script>