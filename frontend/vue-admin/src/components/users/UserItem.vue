<template>
  <tr>
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
</template>

<script>
import dropdownComponents from '@/components/UI/dropdown'
import userService from "@/services/user.service";

export default {
  name: "UserItem",
  components: {
    ...dropdownComponents
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  methods: {
    deleteUser(id) {
      userService.delete(id).then(res => {
        this.$emit('userRemoved')
      })
    },
    banUser(id) {
      userService.ban(id, true).then(res => {
        this.$emit('userRemoved')
      })
    }
  }
}
</script>

<style scoped>
.actions_button {
  cursor: pointer;
  margin-left: 12px;
  margin-top: 3px;
}
</style>