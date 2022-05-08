<template>
  <main class="form-signin">
    <Form @submit="login" :validation-schema="schema">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

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
            name="password"
            type="password"
            class="form-control"
            placeholder="Password"
            v-model="data.password"
        />
        <label>Password</label>
        <ErrorMessage name="password" class="error_msg"/>
      </div>

      <div class="checkbox mb-3 mt-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button
          class="w-100 btn btn-lg btn-primary"
          type="submit"
      >Sign in</button>
    </Form>

    <p
        class="pt-2"
        style="color: #ff473a"
        v-if="loginFailed"
    >
      An error occurred while trying to login. Please check your credentials.
    </p>

    <p class="pt-2">
      Don't have an account yet? <router-link :to="{name: 'register'}">Sign up</router-link> now!
    </p>
  </main>
</template>

<script>
import {mapActions} from "vuex";
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "Login",
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8)
    })
    return {
      schema
    }
  },
  data() {
    return {
      data: {
        email: '',
        password: ''
      },
      loginFailed: false
    }
  },
  methods: {
    ...mapActions({
      loginRequest: 'auth/login'
    }),
    async login(event) {
      const loginStatus = await this.loginRequest(this.data)
      if(loginStatus) {
        await this.$router.push({name: 'dashboard'})
      } else {
        this.loginFailed = true
      }
    }
  },
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