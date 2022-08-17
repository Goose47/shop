<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="page_title">Product List</h2>
      <router-link
          :to="{name: 'products.add'}"
          class="btn btn-sm btn-outline-primary mb-2"
      >
        Add a product
      </router-link>
    </div>

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <ProductItem
              v-for="product in products"
              :key="product.id"
              :product="product"
              @productDeleted="deleteProduct"
          >
          </ProductItem>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import productService from "@/services/product.service";
import ProductItem from "@/components/products/ProductItem";

export default {
  name: "ProductList",
  components: {
    ProductItem
  },
  data() {
    return {
      products: []
    }
  },
  methods: {
    async fetchProducts() {
      const res = await productService.index()
      this.products = res.data.data
    },
    deleteProduct(id) {
      productService.delete(id).then(res => {
        this.products = this.products.filter(p => p.id !== id)
      })
    }
  },
  mounted() {
    this.fetchProducts()
  },
}
</script>

<style scoped>
</style>