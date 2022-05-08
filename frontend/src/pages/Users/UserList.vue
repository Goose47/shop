<template>
  <h2>List of Customers</h2>
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
      <tr v-for="user in users">
        <td>{{ user.id }}</td>
        <td>{{ user.full_name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.phone_number }}</td>
        <td class="d-flex">
          <router-link
              class="btn btn-sm btn-outline-secondary"
              :to="{name: 'users.view', params: {id: user.id}}"
          >
            View
          </router-link>
          <router-link
              class="btn btn-sm btn-outline-secondary"
              :to="{name: 'users.edit', params: {id: user.id}}"
          >
            Edit
          </router-link>
          <AppDropdown>
            <template #toggler><img class="actions_button" src="@/assets/three-dots.svg" alt=""></template>
            <AppDropdownContent>
              <AppDropdownItem><button @click="deleteUser(user.id)" class="dropdown-item">Delete</button></AppDropdownItem>
              <AppDropdownItem><button @click="banUser(user.id)" class="dropdown-item">Ban</button></AppDropdownItem>
            </AppDropdownContent>
          </AppDropdown>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import userService from "@/services/user.service";
import dropdownComponents from '@/components/UI/dropdown/index'

export default {
  name: "UserList",
  components: {
    ...dropdownComponents
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
    deleteUser(id) {
      userService.delete(id).then(res => {
        this.fetchUsers()
      })
    },
    banUser(id) {
      userService.ban(id, true).then(res => {
        this.fetchUsers()
      })
    }
  },
  mounted() {
    this.fetchUsers()
  }
}

</script>

<style scoped>
.actions_button {
  cursor: pointer;
  margin-left: 12px;
}
</style>