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
        <div><a href="#stream" @click="isDropdownActive=!isDropdownActive">Трансляция</a></div>
        <div><a href="#rooms" @click="isDropdownActive=!isDropdownActive">Материалы</a></div>
        <div><a href="#program" @click="isDropdownActive=!isDropdownActive">Программа</a></div>
        <div><a href="#partners" @click="isDropdownActive=!isDropdownActive">Партнеры</a></div>

        <div class="d-block d-lg-none"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a></div>
      </div>
    </div>
  </div>
</template>
<script>
import { mixin as clickaway } from 'vue-clickaway';
export default {
  props: ['id'],
  mixins: [ clickaway ],
  data() {
    return {
      isDropdownActive: false,
    }
  },
  methods: {
    away() {
      this.isDropdownActive = false;
    }
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
