<template>
  <main class="form-signin">
    <Form @submit="register" :validation-schema="schema">
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

      <div class="form-floating">
        <Field
            name="first_name"
            class="form-control"
            placeholder="name@example.com"
            v-model="data.first_name"
        />
        <label>First Name</label>
        <ErrorMessage name="first_name" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="last_name"
            class="form-control"
            placeholder="name@example.com"
            v-model="data.last_name"
        />
        <label>Last Name</label>
        <ErrorMessage name="last_name" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="phone_number"
            class="form-control"
            placeholder="name@example.com"
            v-model="data.phone_number"
        />
        <label>Phone Number</label>
        <ErrorMessage name="phone_number" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="email"
            class="form-control"
            placeholder="name@example.com"
            v-model="data.email"
        />
        <label>Email address</label>
        <ErrorMessage name="email" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            type="password"
            name="password"
            class="form-control mb-0"
            placeholder="Password"
            v-model="data.password"
        />
        <label>Password</label>
        <ErrorMessage name="password" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Confirm your password"
            v-model="data.password_confirmation"
        />
        <label>Password Confirmation</label>
        <ErrorMessage name="password_confirmation" class="error_msg"/>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
      <p
          class="error_msg"
          v-for="error in errors"
      >{{error[0]}}</p>
    </Form>
  </main>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import authService from "@/services/auth.service";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "Register",
  setup() {
    const schema = yup.object({
      first_name: yup.string().required("First name is required"),
      last_name: yup.string().required("Last name is required"),
      email: yup.string().required("Email is required").email(),
      phone_number: yup.number().typeError("Phone must be a number"),
      password: yup.string().required().min(8),
      password_confirmation: yup.string().oneOf([yup.ref('password')], "Passwords do not match").required("Confirm your password")
    })
    return {
      schema
    }
  },
  data() {
    return {
      data: {
        first_name: '',
        last_name: '',
        email: '',
        phone_number: '',
        password: '',
        password_confirmation: ''
      },
      errors: []
    }
  },
  methods: {
    register() {
      console.log(this.data)
      authService.register(this.data).then(res => {
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