<template>
  <div class="online-food tab-pane fade in active show" id="online_order">
    <div class="single-category-food" v-if="menu">
      <div class="single-category-main-content">
        <div class="row" v-for="category in categories" :key="category.id">
            <div class="col-lg-12">
                <div class="category-title">
                    <h3>{{category.cat_name}}</h3>
                </div>
            </div>
          <div class="col-lg-6 mb-30" v-for="item in category.menu" :key="item.id">
            <div class="single-food-card">
              <div class="row">
                <div class="col-lg-2">
                  <div class="food-img">
                    <img src="" alt="" />
                  </div>
                </div>
                <div class="col-lg-10">
                  <div class="food-another">
                    <h5>{{item.item_name}}</h5>
                    <p style="word-break: break-word">{{ item.item_description ? item.item_description :'-'}}</p>
                    <div class="food-price-action d-flex">
                      <span class="food-price">$ {{item.item_price}}</span>
                      <div class="food-action">
                        <a href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                      </div>
                    </div>
                  </div>
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
      outlet: this.$store.state.outletData,
      menu: []
    };
  },
  computed: {
      categories: function (){
          return this.menu.filter(category => category.menu != '')
      }
  },
  methods: {
    getMenu() {
      this.$store
        .dispatch("getmenu", {
          outletID: this.outlet.id,
        })
        .then((response) => {
          if (response.status == true) {
              this.menu = response.menu;
          } else {
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addToCart(){
        this.$store.commit('addToCart', this.product)
    }
  },
  beforeMount() {
    this.getMenu();
  },
};
</script>
