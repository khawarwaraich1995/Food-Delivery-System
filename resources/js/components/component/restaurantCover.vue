<template>
  <div class="col-lg-12 p-0">
    <div class="store-banner-img">
      <img
        src="https://food.amwork.xyz/uploads/dummy/seller/seller9.jpg"
        alt=""
      />
      <div class="conatiner">
        <div class="row">
          <div class="col-lg-8 p-0">
            <div class="store-info">
              <div class="store-logo d-flex">
                <img :src="outlet.outlet_logo" alt="" />
                <div class="store-another-content d-block">
                  <div class="d-flex">
                    <h3>{{outlet.name}}</h3>
                    <span class="badge badge-red">Open</span>
                  </div>
                  <p class="first">
                    <i class="fas fa-map-marker-alt"></i> {{outlet.address}}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 p-0">
            <div class="store-main-info f-right">
              <div class="store-avg-time">
                <div class="delivery-ag-time">
                  <i class="far fa-clock"></i>
                  <span>21 MIN</span>
                </div>
              </div>
              <div class="store-rating-area d-flex">
                <div class="total-avg-rating">
                  <p><i class="fas fa-star"></i> 4.4</p>
                </div>
                <div class="total-rating">
                  <p>5 Ratings</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
