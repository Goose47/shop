<template>
  <main class="form-signin">
    <Form @submit="register" :validation-schema="schema">
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

      <div class="form-floating">
        <Field
            name="first_name"
            class="form-control"
            placeholder="name@example.com"
            v-model="user.first_name"
        />
        <label>First Name</label>
        <ErrorMessage name="first_name" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="last_name"
            class="form-control"
            placeholder="name@example.com"
            v-model="user.last_name"
        />
        <label>Last Name</label>
        <ErrorMessage name="last_name" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="phone_number"
            class="form-control"
            placeholder="name@example.com"
            v-model="user.phone_number"
        />
        <label>Phone Number</label>
        <ErrorMessage name="phone_number" class="error_msg"/>
      </div>
      <div class="form-floating">
        <Field
            name="email"
            class="form-control"
            placeholder="name@example.com"
            v-model="user.email"
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
            v-model="user.password"
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
            v-model="user.password_confirmation"
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
import authService from "@/services/auth.service";
import schema from "@/schemas/users/userCreateSchema";
import userWithPasswordFieldsObjectMixin from "@/mixins/objects/userWithPasswordFieldsObjectMixin";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "Register",
  mixins: [
      userWithPasswordFieldsObjectMixin
  ],
  setup() {
    return {
      schema
    }
  },
  data() {
    return {
      errors: []
    }
  },
  methods: {
    register() {
      console.log(this.data)
      authService.register(this.user).then(res => {
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