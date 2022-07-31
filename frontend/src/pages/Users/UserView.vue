<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="page_title">User #{{ user.id }}</h2>
  </div>

  <p>{{user.full_name}}</p>
  <p>{{user.email}}</p>
  <p>{{user.phone_number}}</p>
</template>

<script>
import userService from "@/services/user.service";
import userObjectMixin from "@/mixins/objects/userObjectMixin";

export default {
  name: "UserView",
  mixins: [
      userObjectMixin
  ],
  methods: {
    async fetchUser(id) {
      const res = await userService.find(id)
      this.user = res.data
    }
  },
  mounted() {
    this.fetchUser(this.$route.params.id)
  }
}
</script>

<style scoped>

</style>