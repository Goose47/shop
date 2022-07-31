<template>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h2 class="page_title">Edit user</h2>
</div>
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
import router from "@/router";
import userObjectMixin from "@/mixins/objects/userObjectMixin";
import schema from "@/schemas/users/userEditSchema";

export default {
  components: {
    Form, Field, ErrorMessage
  },
  name: "UserEdit",
  mixins: [
    userObjectMixin
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