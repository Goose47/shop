<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="page_title">List of Customers</h2>
      <router-link
          :to="{name: 'users.add'}"
          class="btn btn-sm btn-outline-primary mb-2"
      >
        Add a user
      </router-link>
    </div>

    <input v-model="params.search" @input="searchUsers" class="form-control form-control-dark w-100 search_input" type="text" placeholder="Search" aria-label="Search">

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
        <tr>
          <TableHeaderSort @sortAdded="sortUsers" filterName="id">#</TableHeaderSort>
          <TableHeaderSort @sortAdded="sortUsers" filterName="full_name">Name</TableHeaderSort>
          <TableHeaderSort @sortAdded="sortUsers" filterName="email">Email</TableHeaderSort>
          <TableHeaderSort @sortAdded="sortUsers" filterName="phone_number">Phone Number</TableHeaderSort>
          <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <div v-if="isLoading" style="align-items: center;">
          <AppSpinner/>
        </div>
        <UserItem
            v-else
            v-for="user in users"
            :user="user"
            :key="user.id"
            @userRemoved="fetchUsers"
        >
        </UserItem>
        </tbody>
      </table>
      <div class="pagination_section">
        <span>Items per page: {{ paginationData.per_page }}</span>
        <span style="padding-left: 10px;">{{ itemsOfTotal }}</span>
        <button
          class="pagination_button"
          @click="prevPage"
        >
          <img src="@/assets/arrow_left.png">
        </button>
        <span>{{ paginationData.current_page }}</span>
        <button
          class="pagination_button"
          @click="nextPage"
        >
          <img src="@/assets/arrow_right.png">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import userService from "@/services/user.service";
import UserItem from "@/components/users/UserItem";
import TableHeaderSort from "@/components/TableHeaderSort";

export default {
  name: "UserList",
  components: {
    UserItem, TableHeaderSort
  },
  data() {
    return {
      isLoading: true,
      users: [],
      paginationData: {
        current_page: 0,
        per_page: 0,
        total_pages: 0,
        total: 0,
        count: 0,
        links: {
          previous: '',
          next: '',
        }
      },
      params: {
        sort: [],
        search: '',
        per_page: 4,
        page: 1
      }
    }
  },
  methods: {
    async fetchUsers() {
      this.isLoading = true
      const res = await userService.index(this.params)
      this.users = res.data.data
      this.paginationData = res.data.meta.pagination
      this.params.page = res.data.meta.pagination.current_page
      setTimeout(() => {
        this.isLoading = false
      }, 2000)
    },
    sortUsers(sort) {
      //Removing sort parameter with the same name
      this.params.sort = this.params.sort.filter(([key, value]) => key !== sort.name)
      //Adding that sort parameter with new value if value exists
      if (sort.value !== null) {
        this.params.sort.push([sort.name, sort.value]);
      }

      this.fetchUsers()
    },
    searchUsers(event) {
      this.fetchUsers()
    },
    nextPage() {
      if (this.paginationData.links.next) {
        this.params.page++
        this.fetchUsers()
      }
    },
    prevPage() {
      if (this.paginationData.links.previous) {
        this.params.page--
        this.fetchUsers()
      }
    }
  },
  computed: {
    itemsOfTotal() {
      return 1 + this.paginationData.per_page * (this.paginationData.current_page - 1) + '-' + this.paginationData.current_page * this.paginationData.per_page + ' of ' + this.paginationData.total
    }
  },
  mounted() {
    this.fetchUsers()
  }
}

</script>

<style scoped>
.search_input {
  background-color: rgb(33,37,41);
  color: white;
}
.pagination_section {
  float: right;
  display: flex;
  align-items: center;
}
.pagination_button {
  border: none;
  background-color: transparent;
}
.pagination_button img {
  max-width: 15px;
}
</style>