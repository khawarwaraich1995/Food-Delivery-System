<template>
    <div>
        <div class="settings-content-area">
      <h4>Settings</h4>
      <vs-alert color="success" v-show="success">
                    <template #title>
                      Success!
                      {{ successMsj }}
                    </template>
                  </vs-alert>
      <form @submit.prevent="updatePassword">
        <div class="row">
          <div class="col-lg-12">
            <h5>Password Change</h5>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input
                type="password"
                class="form-control"
                placeholder="Current Password"
                v-model="oldPassword"
              />
              <span
                  class="error-block"
                  v-if="has_error && errors.oldPassword"
                  >{{ errors.oldPassword[0] }}</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input
                type="password"
                class="form-control"
                placeholder="New Password"
                v-model="newPassword"
              />
              <span
                  class="error-block"
                  v-if="has_error && errors.newPassword"
                  >{{ errors.newPassword[0] }}</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input
                type="password"
                class="form-control"
                placeholder="Confirm Password"
                v-model="confirmPassword"
              />
                     <span
                  class="error-block"
                  v-if="has_error && errors.confirmPassword"
                  >{{ errors.confirmPassword[0] }}</span>
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
      oldPassword: '',
      newPassword: '',
      confirmPassword: '',
      has_error: false,
      errors: '',
      success: false,
      successMsj: '',
    }
  },
  methods: {
    updatePassword () {
      this.resetErros()
      if(this.newPassword != this.confirmPassword)
      {
           this.has_error = true;
           this.errors =  {'confirmPassword': ["Confirm password not matched with New password!"]};
           return false;
      }
      this.$store
        .dispatch('updatePassword', {
          customerID: this.customerID,
          oldPassword: this.oldPassword,
          newPassword: this.newPassword,
          confirmPassword: this.confirmPassword,
        })
        .then((response) => {
          if(response.status == true)
          {
            this.resetFields()
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
    },
    resetFields(){
       this.oldPassword = '';
       this.newPassword = '';
       this.confirmPassword = '';
    }
  }
}
</script>