<template>
  <p>{{user.id}}</p>
  <p>{{user.full_name}}</p>
  <p>{{user.email}}</p>
  <p>{{user.phone_number}}</p>
</template>

<script>
import userService from "@/services/user.service";

export default {
  name: "UserView",
  data() {
    return {
      user: {
        id: 0,
        first_name: '',
        last_name: '',
        email: '',
        phone_number: 0,
      }
    }
  },
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