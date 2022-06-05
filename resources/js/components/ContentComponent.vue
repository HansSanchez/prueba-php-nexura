<template>
    <transition name="bounce">
        <router-view></router-view>
    </transition>
</template>

<script>
    export default {
        name: "ContentComponent",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
.bounce-enter-active {
    animation: bounce-in 1s;
}

.bounce-leave-active {
    animation: bounce-in 1s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }

    50% {
        transform: scale(1.5);
    }

    100% {
        transform: scale(1);
    }
}

</style>
