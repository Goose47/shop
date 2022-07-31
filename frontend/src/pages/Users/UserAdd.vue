<template>
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
            v-model="user.first_name"
        />
        <ErrorMessage name="first_name" class="error_msg"/>
      </div>

      <div class="col-sm-6">
        <label class="form-label">Last name</label>
        <Field
            type="text"
            class="form-control"
            placeholder="Johnson"
            name="last_name"
            v-model="user.last_name"
        />
        <ErrorMessage name="last_name" class="error_msg"/>
      </div>

      <div class="col-12">
        <label class="form-label">Email</label>
        <Field type="text"
               class="form-control"
               placeholder="you@example.com"
               name="email"
               v-model="user.email"
        />
        <ErrorMessage name="email" class="error_msg"/>
      </div>

      <div class="col-12">
        <label class="form-label">Phone Number</label>
        <Field
            type="text"
            class="form-control"
            placeholder="7831982739871"
            name="phone_number"
            v-model="user.phone_number"
        />
        <ErrorMessage name="phone_number" class="error_msg"/>
      </div>

      <div class="col-12">
        <label class="form-label">Password</label>
        <Field
            type="password"
            class="form-control"
            name="password"
            v-model="user.password"
        />
        <ErrorMessage name="password" class="error_msg"/>
      </div>

      <div class="col-12">
        <label class="form-label">Password Confirmation</label>
        <Field
            type="password"
            class="form-control"
            name="password_confirmation"
            v-model="user.password_confirmation"
        />
        <ErrorMessage name="password_confirmation" class="error_msg"/>
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
</template>

<script>
import {ErrorMessage, Field, Form} from "vee-validate";
import userService from "@/services/user.service";
import userWithPasswordFieldsObjectMixin from "@/mixins/objects/userWithPasswordFieldsObjectMixin";
import schema from "@/schemas/users/userCreateSchema";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "UserAdd",
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
    createUser() {
      userService.store(this.user).then(res => {
        this.$router.push({name: 'users.index'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    }
  }
}
</script>

<style scoped>

</style>