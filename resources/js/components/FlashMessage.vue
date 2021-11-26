<template>
<div class="alert alert-message cursor-pointer" v-show="show" @click="hideQuick">    
    {{ body }}
</div>
</template>

<script>
export default {
    props: ['message'],

    data() {
        return {
            body: '',
            show: false
        }
    },

    created() {
        if (this.message) {
            this.flash(this.message);
        }

        window.events.$on('flash', message => this.flash(message))
    },

    methods: {
        flash(message) {
            this.body = message;
            this.show = true;

            this.hide();
        },
        hideQuick() {
           this.show = false
        },
        hide() {
            setTimeout(() => {
                this.show = false
            }, 4000);
        }
    }
}
</script>
