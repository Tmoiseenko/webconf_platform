<template>
    <span class="nav-link" @click="show">Присоединиться</span>
</template>

<script>
    export default {
        methods: {
            show () {
                this.$modal.show('register-modal');
            },
            hide () {
                this.$modal.hide('register-modal');
            }
        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
