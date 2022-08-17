<template>
  <th class="table_header">
    <button @click="changeSort" class="table_button">
      <strong><slot></slot></strong>
      <Transition>
        <img v-if="selectedSort !== null" class="table_item_image" :src="arrowDirection">
      </Transition>
    </button>
  </th>
</template>

<script>
export default {
  name: "TableHeaderSort",
  props: {
    filterName: {
      required: true,
      type: String
    }
  },
  emits: [
    'sortAdded'
  ],
  data() {
    return {
      selectedSort: null
    }
  },
  methods: {
    changeSort() {
      if (this.selectedSort === null) {
        this.selectedSort = true
        this.$emit('sortAdded', {
          name: this.filterName,
          value: this.selectedSort
        })
      } else if (this.selectedSort) {
        this.selectedSort = false
        this.$emit('sortAdded', {
          name: this.filterName,
          value: this.selectedSort
        })
      } else {
        this.selectedSort = null;
        this.$emit('sortAdded', {
          name: this.filterName,
          value: this.selectedSort
        })
      }
    }
  },
  computed: {
    arrowDirection() {
      if (this.selectedSort) {
        return require('@/assets/arrow_down.png')
      } else {
        return require('@/assets/arrow_up.png')
      }
    }
  }
}
</script>

<style scoped>
.table_button {
  border: none;
  background-color: transparent;
}
.table_item_image {
  max-width: 15px;
  padding-left: 5px;
}
.table_header {
  align-content: space-between;
  align-items: center;
}

v-enter-from,
v-leave-to
{
  opacity: 0;
}
v-enter-active,
v-leave-active
{
  transition: opacity 0.9s ease-out;
}
v-enter-to,
v-leave-from
{
  opacity: 1;
}
</style>