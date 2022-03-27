<template>
  <div>
    <div class="settings-content-area">
      <h4>Profile Update</h4>
       <vs-alert color="success" v-show="success">
                    <template #title>
                      Success!
                      {{ successMsj }}
                    </template>
                  </vs-alert>
      <form @submit.prevent="updateProfile">
        <div class="row">
          <div class="col-lg-12 offset-lg-9">
            <div class="profile-img">
                <img src="https://cdn.icon-icons.com/icons2/1736/PNG/512/4043260-avatar-male-man-portrait_113269.png" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
              <label for="name">Name</label>
              <input
                type="text"
                class="form-control"
                v-model="customerName"
                placeholder="Full Name"
              />
              <span
                  class="error-block"
                  v-if="has_error && errors.name"
                  >{{ errors.name[0] }}</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                class="form-control"
                placeholder="Email"
                id="email"
                v-model="customerEmail"
                disabled
              />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="">Phone</label>
              <vue-phone-number-input default-country-code="PK" ref="phone" v-model="customerPhone"></vue-phone-number-input>
            <span
                  class="error-block"
                  v-if="has_error && errors.phone"
                  >{{ errors.phone }}</span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="btn-submit f-right">
              <button type="submit">Update</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: [
   'userDetails'
  ],
  data () {
    return {
      customerID: this.userDetails.id,
      customerName: this.userDetails.name,
      customerEmail: this.userDetails.email,
      customerPhone: this.userDetails.phone,
      has_error: false,
      errors: '',
      success: false,
      successMsj: '',
    }
  },
  methods: {
    updateProfile () {
      this.resetErros()
      let phoneValid = this.$refs.phone.isValid;
      let phoneValue = this.$refs.phone.value;
      if(phoneValue != '' && !phoneValid)
      {
           this.has_error = true;
           this.errors =  {'phone': "Invalid phone number format!"};
           return false;
      }
      this.$store
        .dispatch('updateProfile', {
          customerID: this.customerID,
          name: this.customerName,
          phone: this.customerPhone,
        })
        .then((response) => {
          if(response.status == true)
          {
            this.resetErros()
            this.success = true;
            this.successMsj = response.message;
          }else{
            let messageErr = response.message;
            this.error = true;
            this.errMsj = messageErr;
          }
          
        })
        .catch(err => {
           if (err.response.data) {
            this.has_error = true;
            this.errors = err.response.data.errors || {};
          } else {
            console.log(err);
          }
        })
    },
    resetErros(){
      this.has_error = false;
      this.errors =  '';
    }
  }
}
</script>