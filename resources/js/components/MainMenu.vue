<template>
    <div
        class="dropdown is-right"
        v-bind:class="{ 'is-active': isDropdownActive }"
        v-on-clickaway="away"
    >
        <div
            class="dropdown-trigger"
            @click="isDropdownActive=!isDropdownActive"
        >
            <a
                aria-haspopup="true"
                aria-controls="{ 'dropdown-menu'}"
            >
                <i class="fas fa-bars gamburger"></i>
            </a>
        </div>
        <div
            class="dropdown-menu"
            id="dropdown-menu"
            role="menu"
        >
            <div class="dropdown-content">
                <div v-for="link in navLinks">
                    <a v-bind:href="link.id" @click="isDropdownActive=!isDropdownActive">{{ link.title }}</a>
                </div>
                <a target="_blank" href="/admin" v-if="isManage">Админпанель</a>
            </div>
        </div>
    </div>
</template>
<script>
import {mixin as clickaway} from 'vue-clickaway';

export default {
    props: {
        user: String,
    },
    mixins: [clickaway],
    data() {
        return {
            isDropdownActive: false,
            navLinks: [
                {id: '#stream', title: 'Трансляция'},
                {id: '#rooms', title: 'Комнаты'},
                {id: '#materials', title: 'Материалы'},
                {id: '#program', title: 'Программа'},
                {id: '#partners', title: 'Партнеры'},
            ],
            authUser: '',
            isManage: false,
        }
    },
    mounted() {
        this.authUser = this.user != '' ? JSON.parse(this.user) : ''
        this.isManagerCheck()
    },
    methods: {
        away() {
            this.isDropdownActive = false;
        },
        isManagerCheck() {
            if (this.authUser.roles.find(x => x.slug === 'manager') !== undefined) {
                if (this.authUser.roles.find(x => x.slug === 'manager').slug === 'manager') {
                    this.isManage = true
                    return true
                }
            }
            return false
        },
    }
};
</script>
<style scoped>
.dropdown-trigger {
    color: #fff;
    font-size: 2rem;
}

.gamburger {
    transition: all 0.2s;
}

.gamburger:hover {
    transform: scale(1.3);
}
</style>
