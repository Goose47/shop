<template>
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
        <ErrorMessage name="name" class="error_msg"/>
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
              @keydown="priceInput"
          />
        </div>
        <ErrorMessage name="price" class="error_msg"/>
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
        <ErrorMessage name="description" class="error_msg"/>
      </div>
    </div>

    <hr class="my-4">
<!--    <h4>Upload Images</h4>-->
<!--    <p>Choose up to 3 images:</p>-->

<!--    <div class="form-group max-w10 pb-2">-->
<!--      <Field-->
<!--        name="images"-->
<!--        class="upload_button"-->
<!--        type="file"-->
<!--        multiple-->
<!--        @change="imageChosen"-->
<!--      />-->
<!--      <ErrorMessage name="images" class="error_msg"/>-->
<!--    </div>-->

<!--    <div-->
<!--      class="image_container"-->
<!--    >-->
<!--        <img-->
<!--          :ref="'image'"-->
<!--          v-for="(image, key) in images"-->
<!--          :key="key"-->
<!--          class="preview_image"-->
<!--        />-->
<!--    </div>-->
    <ImageUpload @imageUploaded="imageUploaded"></ImageUpload>

    <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Create Product</button>
    <p
        class="error_msg"
        v-for="error in errors"
    >
      {{ error[0] }}
    </p>
  </Form>
</template>

<script>
import {ErrorMessage, Field, Form} from 'vee-validate';
import schema from '@/schemas/products/productCreateSchema'
import AppModal from "@/components/UI/modal/AppModal";
import ImageUpload from "@/components/ImageUpload";

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
        formData.append('images[]', image)
      }

      productService.store(formData).then(res => {
        this.$router.push({name: 'products.index'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    },
    imageUploaded(image) {
      this.images.push(image)
    },
    // custom image upload and preview

    // imageChosen(event) {
    //   this.images = []
    //   let selectedImages = event.target.files
    //
    //   for(let i = 0; i <=2; i++) {
    //     if (selectedImages[i]) {
    //       this.images.push(selectedImages[i])
    //     }
    //   }
    //
    //   for (let i = 0; i < this.images.length; i++) {
    //     let reader = new FileReader();
    //     reader.onload = (event) => {
    //       this.$refs.image[i].src = reader.result;
    //     };
    //
    //     reader.readAsDataURL(this.images[i]);
    //   }
    // },
    priceInput(e) {
      // if(this.price && this.price.includes('.') && this.price.split('.')[1].length >= 2) {
      //   e.preventDefault()
      // }
    }
  }
}
</script>

<style scoped>
.image_container {
  display: flex;
}
.preview_image {
  width: 33%;
}
</style>