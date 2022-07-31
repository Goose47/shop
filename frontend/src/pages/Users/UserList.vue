<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="page_title">List of Customers</h2>
    <router-link
        :to="{name: 'users.add'}"
        class="btn btn-sm btn-outline-primary mb-2"
    >
      Add a user
    </router-link>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Actions</th>
      </tr>
      </thead>
      <tbody>
      <UserItem
          v-for="user in users"
          :user="user"
          :key="user.id"
          @userRemoved="fetchUsers"
      >
      </UserItem>
      </tbody>
    </table>
  </div>
</template>

<script>
import userService from "@/services/user.service";
import UserItem from "@/components/UserItem";
import AppModal from "@/components/UI/modal/AppModal";
import UserAdd from "@/pages/Users/UserAdd";

export default {
  name: "UserList",
  components: {
    UserItem, AppModal, UserAdd
  },
  data() {
    return {
      users: []
    }
  },
  methods: {
    async fetchUsers() {
      const res = await userService.index()
      this.users = res.data
    },
  },
  mounted() {
    this.fetchUsers()
  }
}

</script>

<style scoped>
</style>