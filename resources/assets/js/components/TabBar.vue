<template>
    <div class="tabbar">
        <slot></slot>
    </div>
</template>
<style scoped>
    .tabbar {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        align-content: center;
        height: 38pt;
    }
</style>