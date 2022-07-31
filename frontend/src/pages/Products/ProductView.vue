<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="page_title">Product #{{ product.id }}</h2>
  </div>

  <h4>{{ product.name }}</h4>
  <p>{{product.description}}</p>
  <p class="card-text"><strong>Price: </strong>${{ product.price / 100 }}</p>

  <div class="image_container">
    <img
        class="product_image"
        v-for="image in product.images"
        :src="image.path"
        alt=""
    >
  </div>

  <hr class="my-1">

  <p><strong>Created at: </strong>{{ product.created_at }}</p>
  <p><strong>Updated last at: </strong>{{ product.updated_at }}</p>
</template>

<script>
import productService from "@/services/product.service";

export default {
  name: "ProductView",
  data() {
    return {
      product: {
        id: null,
        name: '',
        description: '',
        price: null,
        images: [],
        created_at: null,
        updated_at: null,
      }
    }
  },
  methods: {
    async fetchProduct() {
      const res = await productService.find(this.$route.params.id)

      this.product = res.data
    }
  },
  mounted() {
    this.fetchProduct()
  }
}
</script>

<style scoped>
.image_container {
  justify-content: space-evenly;
  display: flex;
}
.product_image{
  max-width: 33%;
}
</style>