<template>
    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div class="col" v-for="product in products">
            <div class="card shadow-sm">
              <img class="product_image" :src="product.images[0].path" alt=":(">

              <div class="card-body">
                <p>#{{ product.id }}</p>
                <span><strong>{{ product.name }}</strong></span>
                <p class="card-text">{{ product.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <router-link :to="{name: 'products.view', params: {id: product.id}}" class="btn btn-sm btn-outline-secondary">View</router-link>
                    <router-link :to="{name: 'products.edit', params: {id: product.id}}" class="btn btn-sm btn-outline-secondary">Edit</router-link>
                  </div>
                  <small class="text-muted">9 mins ago</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import productService from "@/services/product.service";

export default {
  name: "ProductList",
  data() {
    return {
      products: []
    }
  },
  methods: {
    async fetchProducts() {
      const res = await productService.index()
      this.products = res.data
    }
  },
  mounted() {
    this.fetchProducts()
  },
}
</script>

<style scoped>
.product_image {
  height: 225px;
  width: 100%;
}
</style>