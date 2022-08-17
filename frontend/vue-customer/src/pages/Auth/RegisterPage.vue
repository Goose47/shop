<template>
  <div>
    <main class="form-signin">
      <Form @submit="register" :validation-schema="schema">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

        <div class="form-floating">
          <Field
              name="first_name"
              class="form-control"
              placeholder="name@example.com"
              v-model="first_name"
          />
          <label>First Name</label>
          <AppPopup>
            <ErrorMessage name="first_name" class="error_msg"/>
          </AppPopup>
        </div>
        <div class="form-floating">
          <Field
              name="last_name"
              class="form-control"
              placeholder="name@example.com"
              v-model="last_name"
          />
          <label>Last Name</label>
          <AppPopup>
            <ErrorMessage name="last_name" class="error_msg"/>
          </AppPopup>
        </div>
        <div class="form-floating">
          <Field
              name="phone_number"
              class="form-control"
              placeholder="name@example.com"
              v-model="phone_number"
          />
          <label>Phone Number</label>
          <AppPopup>
            <ErrorMessage name="phone_number" class="error_msg"/>
          </AppPopup>
        </div>
        <div class="form-floating">
          <Field
              name="email"
              class="form-control"
              placeholder="name@example.com"
              v-model="email"
          />
          <label>Email address</label>
          <AppPopup>
            <ErrorMessage name="email" class="error_msg"/>
          </AppPopup>
        </div>
        <div class="form-floating">
          <Field
              type="password"
              name="password"
              class="form-control mb-0"
              placeholder="Password"
              v-model="password"
          />
          <label>Password</label>
          <AppPopup>
            <ErrorMessage name="password" class="error_msg"/>
          </AppPopup>
        </div>
        <div class="form-floating">
          <Field
              type="password"
              name="password_confirmation"
              class="form-control"
              placeholder="Confirm your password"
              v-model="password_confirmation"
          />
          <label>Password Confirmation</label>
          <AppPopup>
            <ErrorMessage name="password_confirmation" class="error_msg"/>
          </AppPopup>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        <p
            class="error_msg"
            v-for="error in errors"
        >{{error[0]}}</p>
      </Form>
    </main>
  </div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import authService from "@/services/auth.service";
import schema from "@/schemas/userCreateSchema";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "Register",
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
      errors: []
    }
  },
  methods: {
    register() {
      const user = {
        'first_name': this.first_name,
        'last_name': this.last_name,
        'email': this.email,
        'phone_number': this.phone_number,
        'password': this.password,
        'password_confirmation': this.password_confirmation,
      }

      authService.register(user).then(res => {
        this.$router.push({
          name: "login"
        })
      }).catch(e => {
        this.errors = e.response.data.errors
      })
    }
  }
}
</script>

<style scoped>
html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>