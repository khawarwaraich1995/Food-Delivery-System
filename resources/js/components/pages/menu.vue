<template>
  <div>
    <div id="pjax-container">
      <section>
        <div class="store-area store_fixed">
          <div class="container-fluid">
            <div class="row">
                <restaurant-cover></restaurant-cover>
              <div class="col-lg-9 p-0">
                <div class="store-left-section">
                <restaurant-tabs></restaurant-tabs>
                  <div class="tab-content">
                    <menu-listing></menu-listing>
                    <restaurant-info></restaurant-info>
                    <table-booking></table-booking>
                    <restaurant-rating></restaurant-rating>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 p-0">
                  <cart-card></cart-card>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script>
export default {
    data() {
    return {
      outlet: this.$store.state.outletData
    };
  }
}
</script>

