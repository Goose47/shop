<template>
  <div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="page_title">Add a product</h2>
    </div>

    <Form :validation-schema="schema" @submit="createProduct">
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
          @imageUploaded="imageUploaded"
          @imageRemoved="imageRemoved"
      ></ImageUpload>

      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" type="submit">Create Product</button>
      <AppListPopup>
        <p
            class="error_msg pt-2"
            v-for="(error, key) in errors"
            :key="key"
        >
          {{ error[0] }}
        </p>
      </AppListPopup>
    </Form>
  </div>
</template>

<script>
import {ErrorMessage, Field, Form} from 'vee-validate';
import schema from '@/schemas/products/productCreateSchema'
import AppModal from "@/components/UI/modal/AppModal";
import ImageUpload from "@/components/ImageUploadComponent";

import productService from "@/services/product.service";

export default {
  name: "ProductAdd",
  components: {
    Form, Field, ErrorMessage,
    AppModal, ImageUpload
  },
  setup() {
    return {
      schema
    }
  },
  data() {
    return {
      name: '',
      description: '',
      price: null,
      images: [],
      errors: []
    }
  },
  methods: {
    createProduct() {
      let formData = new FormData()
      formData.append('name', this.name)
      formData.append('description', this.description)

      formData.append('price', this.price)

      for (let image of this.images) {
        formData.append('images[]', image.file)
      }

      productService.store(formData).then(res => {
        this.$router.push({name: 'products.list'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    },
    imageUploaded(image) {
      this.images.push(image)
    },
    imageRemoved(image) {
      this.images = this.images.filter(i => {
        return i.id !== image.id
      })
    }
  }
}
</script>

<style scoped>
</style>