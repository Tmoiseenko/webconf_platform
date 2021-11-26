<template>
    <span class="nav-link" @click="show">Войти</span>
</template>

<script>
    export default {
        methods: {
            show () {
                this.$modal.show('login-modal');
            },
            hide () {
                this.$modal.hide('login-modal');
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
