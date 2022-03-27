<template>
  <div class="layout-app">
    <app-header></app-header>
    <router-view></router-view>
    <app-footer></app-footer>
  </div>
</template>
<script>
export default {
  name: "App",
  props: {
    outletData: {
      required: true,
    },
  },
  methods: {
    storeOutletData: function () {
      localStorage.setItem('outletData', JSON.stringify(this.outletData))
      this.$store.state.outletData = this.outletData;
    },
  },
  beforeMount() {
    this.storeOutletData();
  },
};
</script>
