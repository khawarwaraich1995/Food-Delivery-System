<template>
  <div>
    <div class="store-right-section fixed">
      <div class="delivery-main-content text-center">
          <div class="delivery-toogle-action">
            <span class="delivery-title">Delivery</span>
            <div class="custom-control custom-switch">
              <input
                type="checkbox"
                name="delivery_type"
                value="0"
                class="custom-control-input"
                id="check"
              />
              <label class="custom-control-label" for="check">Pick Up</label>
            </div>
          </div>
          <div class="delivery-avg-time" id="dummy">
            <i class="fas fa-truck"></i> 21 min
          </div>
          <div class="delivery-order-form">
            <h5>Your order Bar B Q Tonight</h5>
          </div>
          <div class="cart-product-list">
            <div class="single-cart-product d-flex">
              <div class="cart-product-title d-block">
                <h5>Beef Kabab</h5>
                <p>Regular</p>
              </div>
              <div class="cart-price-action d-block">
                <span>USD 22.00</span>
                <div class="cart-product-action d-flex">
                  <a href="" class="right"
                    ><span class="fas fa-trash"></span
                  ></a>
                  <div class="qty">
                    <input
                      type="text"
                      value="1"
                    />
                  </div>
                  <a class="left"><span class="ti-plus"></span></a>
                </div>
              </div>
            </div>
          </div>
          <div class="cart-product-another-information">
            <div class="single-information d-flex">
              <span>Subtotal</span>
              <div class="main-amount">
                <span>USD 22.00</span>
              </div>
            </div>
            <div>
              <div class="checkout-btn">
                <a href="javascript:void(0)">Checkout</a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>
