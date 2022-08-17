<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="page_title">Create user</h2>
    </div>
    <Form :validation-schema="schema" @submit="createUser">
      <div class="row g-3">
        <div class="col-sm-6">
          <label class="form-label">First name</label>
          <Field
              type="text"
              class="form-control"
              placeholder="John"
              name="first_name"
              v-model="first_name"
          />
          <AppPopup>
            <ErrorMessage name="first_name" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-sm-6">
          <label class="form-label">Last name</label>
          <Field
              type="text"
              class="form-control"
              placeholder="Johnson"
              name="last_name"
              v-model="last_name"
          />
          <AppPopup>
            <ErrorMessage name="last_name" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-12">
          <label class="form-label">Email</label>
          <Field type="text"
                 class="form-control"
                 placeholder="you@example.com"
                 name="email"
                 v-model="email"
          />
          <AppPopup>
            <ErrorMessage name="email" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-12">
          <label class="form-label">Phone Number</label>
          <Field
              type="text"
              class="form-control"
              placeholder="+7 (999) 123-45-67"
              name="phone_number"
              v-model="phone_number"
              @input="acceptNumber"
          />
          <AppPopup>
            <ErrorMessage name="phone_number" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-12">
          <label class="form-label">Password</label>
          <Field
              type="password"
              class="form-control"
              name="password"
              v-model="password"
          />
          <AppPopup>
            <ErrorMessage name="password" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-12">
          <label class="form-label">Password Confirmation</label>
          <Field
              type="password"
              class="form-control"
              name="password_confirmation"
              v-model="password_confirmation"
          />
          <AppPopup>
            <ErrorMessage name="password_confirmation" class="error_msg"/>
          </AppPopup>
        </div>
      </div>

      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" type="submit">Create User</button>
      <p
          class="error_msg"
          v-for="error in errors"
      >
        {{ error[0] }}
      </p>
    </Form>
  </div>
</template>

<script>
import {ErrorMessage, Field, Form} from "vee-validate";
import userService from "@/services/user.service";
import schema from "@/schemas/users/userCreateSchema";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "UserAdd",
  setup() {
    return {
      schema
    }
  },
  data() {
    return {
      first_name: '',
      last_name: '',
      email: '',
      phone_number: '',
      password: '',
      password_confirmation: '',
      errors: [],
    }
  },
  methods: {
    createUser() {
      const user = {
        'first_name': this.first_name,
        'last_name': this.last_name,
        'email': this.email,
        'phone_number': this.phone_number,
        'password': this.password,
        'password_confirmation': this.password_confirmation,
      }
      userService.store(user).then(res => {
        this.$router.push({name: 'users.list'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    },
    acceptNumber() {
      let x = this.phone_number.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
      this.phone_number = '+' + x[1] + ' ' + (!x[3] ? x[2] : '(' + x[2] + ') ' + x[3]) + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
    }
  }
}
</script>

<style scoped>

</style>