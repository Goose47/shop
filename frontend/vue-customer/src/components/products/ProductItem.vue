<template>
  <div class="col">
    <div class="card shadow-sm">
      <img class="product_image" :src="imagePath" alt=":(">

      <div class="card-body product_description">
        <p>#{{ product.id }}</p>
        <span><strong>{{ product.name }}</strong></span>
        <p class="card-text">{{ product.description }}</p>
        <div class="d-flex justify-content-between align-items-center product_buttons">
          <div class="btn-group">
<!--            <router-link :to="{name: 'products.view', params: {id: product.id}}" class="btn btn-sm btn-outline-secondary">View</router-link>-->
<!--            <router-link :to="{name: 'products.edit', params: {id: product.id}}" class="btn btn-sm btn-outline-secondary">Edit</router-link>-->
            <AppDropdown>
              <template #toggler><img class="actions_button" src="@/assets/three-dots.svg" alt=""></template>
              <AppDropdownContent>
                <AppDropdownItem><button @click="$emit('productDeleted', product.id)" class="dropdown-item">Delete</button></AppDropdownItem>
              </AppDropdownContent>
            </AppDropdown>
            <p class="product_price"><strong>Price: </strong>${{ product.price }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dropdownComponents from '@/components/UI/dropdown'

export default {
  name: "ProductItem",
  emits: [
    'productDeleted'
  ],
  components: {
    ...dropdownComponents
  },
  props:{
    product: {
      type: Object,
      required: true
    }
  },
  computed: {
    imagePath() {
      if(this.product.images.length === 0) {
        return require('@/assets/no_image.png')
      }

      return this.product.images[0].path
    }
  }
}
</script>

<style scoped>
.product_image {
  height: 225px;
  width: 100%;
}
.actions_button {
  cursor: pointer;
  margin-left: 12px;
  margin-top: 3px;
}
.product_description {
  height: 200px;
}
.product_buttons {
  width: 100%;
  padding-right: 35px;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  bottom: 15px;
}
.product_price {
  margin: 0;
  padding-left: 10px;
  padding-top: 4px;
}
</style>