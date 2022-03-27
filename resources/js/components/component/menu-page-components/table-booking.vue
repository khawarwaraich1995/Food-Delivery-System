<template>
  <div class="online-food tab-pane fade" id="book">
    <div class="single-category-food mt-50 mb-50">
      <div class="single-category-main-content">
        <div class="row mb-20">
          <div class="col-lg-6">
            <h3>Book A Table</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="group-section">
              <form
                action="https://food.amwork.xyz/book/seasonal-tastes"
                method="POST"
                id="book_form"
              >
                <input
                  type="hidden"
                  name="_token"
                  value="cyJ2vo4jpWdObCzhgYkgbSuRTGe8JEuoJLtN4W0z"
                />
                <div class="book-table-section">
                  <h5 class="mb-15">Booking Information</h5>
                  <div class="form-group">
                    <label>Number of Guests</label>
                    <input
                      type="text"
                      class="form-control"
                      name="number_of_gutes"
                      placeholder="Number of Guests"
                    />
                  </div>
                  <div class="form-group">
                    <label>Date Of Booking</label>
                    <input
                      type="text"
                      class="form-control"
                      id="date"
                      name="date"
                      placeholder="Date Of Booking"
                      autocomplete="off"
                    />
                  </div>
                  <h5 class="mb-15 mt-30">Contact Information</h5>
                  <div class="form-group">
                    <label>Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      placeholder="Name"
                    />
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      placeholder="Email"
                    />
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input
                      type="text"
                      class="form-control"
                      name="mobile"
                      placeholder="Phone Number"
                    />
                  </div>
                  <div class="form-group">
                    <label>Your Instructions</label>
                    <textarea class="form-control" name="message"></textarea>
                  </div>
                  <div class="button-area">
                    <button id="book_submit" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
