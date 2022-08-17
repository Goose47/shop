<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="page_title">Edit product</h2>
    </div>

    <Form :validation-schema="schema" @submit="updateProduct">
      <div class="row g-3">
        <div class="col-sm-6">
          <label class="form-label">Name</label>
          <Field
              type="text"
              class="form-control"
              placeholder="Product Name"
              name="name"
              v-model="name"
          />
          <AppPopup>
            <ErrorMessage name="name" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-sm-3">
          <label class="form-label">Price</label>

          <div class="input-group">
            <span class="input-group-text">$</span>
            <Field
                type="number"
                class="form-control"
                min="0.00" step="1.00"
                name="price"
                v-model="price"
            />
          </div>
          <AppPopup>
            <ErrorMessage name="price" class="error_msg"/>
          </AppPopup>
        </div>

        <div class="col-sm-9">
          <label class="form-label">Description</label>
          <Field
              as="textarea"
              type="text"
              class="form-control input-large"
              placeholder="Product Description"
              name="description"
              v-model="description"
          />
          <AppPopup>
            <ErrorMessage name="description" class="error_msg"/>
          </AppPopup>
        </div>
      </div>

      <hr class="my-4">

      <ImageUpload
          :originalImages="originalImages"
          @imageUploaded="imageUploaded"
          @imageRemoved="imageRemoved"
      ></ImageUpload>

      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" type="submit">Save changes</button>
      <p
          class="error_msg"
          v-for="error in errors"
      >
        {{ error[0] }}
      </p>
    </Form>
  </div>
</template>

<script>
import productService from "@/services/product.service";
import { Form, Field, ErrorMessage } from 'vee-validate';
import ImageUpload from '@/components/ImageUploadComponent';

import schema from '@/schemas/products/productCreateSchema';

export default {
  name: "ProductEdit",
  components: {
    Form, Field, ErrorMessage,
    ImageUpload
  },
  setup() {
    return {
      schema,
      originalImages: []
    }
  },
  data() {
    return {
      id: 0,
      name: '',
      description: '',
      price: null,
      imagesToUpload: [],
      errors: []
    }
  },
  methods: {
    async fetchProduct() {
      const res = await productService.find(this.$route.params.id)
      this.id = res.data.id
      this.name = res.data.name
      this.description = res.data.description
      this.price = res.data.price
      this.originalImages = res.data.images
    },
    updateProduct() {
      const formData = new FormData()

      formData.append('name', this.name)
      formData.append('description', this.description)
      formData.append('price', this.price)

      // Sending an empty array to clear all images
      if (this.imagesToUpload.length === 0) {
        formData.append('images[]', [])
      }
      for (let image of this.imagesToUpload) {
        // If the id of the image is uid then it's an original image
        const value = image.id.length === 36 ? image.id : image.file

        formData.append('images[]', value)
      }

      productService.update(formData, this.id).then(() => {
        this.$router.push({name: 'products.list'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    },
    imageUploaded(image) {
      this.imagesToUpload.push(image)
    },
    imageRemoved(image) {
      this.imagesToUpload = this.imagesToUpload.filter(i => {
        return i.id !== image.id
      })
    },
  },
  mounted() {
    this.fetchProduct()
  }
}
</script>

<style scoped>
</style>