<template>
<div class="container">
  <main>
    <div class="row g-5">
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">User #{{ user.id }}</h4>
        <Form :validation-schema="schema" @submit="updateUser">
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
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Save Changes</button>
          <p
              class="error_msg"
              v-for="error in errors"
          >
            {{ error[0] }}
          </p>
        </Form>
      </div>
    </div>
  </main>
</div>
</template>

<script>
import userService from "@/services/user.service";
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import router from "@/router";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "UserEdit",
  setup() {
    const schema = yup.object({
      first_name: yup.string().required("First name is required"),
      last_name: yup.string().required("Last name is required"),
      email: yup.string().required("Email is required").email("Email must be a valid email address"),
      phone_number: yup.number().typeError("Phone number must be a number"),
    })
    return {
      schema
    }
  },
  data() {
    return {
      user: {
        id: 0,
        first_name: '',
        last_name: '',
        email: '',
        phone_number: 0,
      },
      errors: []
    }
  },
  methods: {
    async fetchUser(id) {
      const res = await userService.find(id)
      this.user = res.data
    },
    updateUser() {
      userService.update(this.user, this.user.id).then(res => {
        router.push({name: 'users.view', params: {id: this.user.id}})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    }
  },
  mounted() {
    this.fetchUser(this.$route.params.id)
  }

}
</script>

<style scoped>

</style>