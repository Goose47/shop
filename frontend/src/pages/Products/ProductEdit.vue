<template>
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
        <ErrorMessage name="name" class="error_msg"/>
      </div>

      <div class="col-sm-3">
        <label class="form-label">Price</label>

        <div class="input-group">
          <span class="input-group-text">$</span>
          <Field
              :ref="'priceInput'"
              type="number"
              class="form-control"
              min="0.00" step="1.00"
              name="price"
              :modelValue="price"
              @update:modelValue="priceInput"
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

<!--    <hr class="my-4">-->
<!--    <h4>Upload Images</h4>-->
<!--    <p>Choose up to 3 images:</p>-->

<!--    <div class="form-group max-w10 pb-2">-->
<!--      <Field-->
<!--          name="images"-->
<!--          class="upload_button"-->
<!--          type="file"-->
<!--          multiple-->
<!--          @change="imageChosen"-->
<!--      />-->
<!--      <ErrorMessage name="images" class="error_msg"/>-->
<!--    </div>-->

    <div class="image_container">
      <img
          v-for="image in images"
          :key="image.id"
          :src="image.path"
          class="preview_image"
      />
    </div>

    <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Save changes</button>
    <p
        class="error_msg"
        v-for="error in errors"
    >
      {{ error[0] }}
    </p>
  </Form>
</template>

<script>
import productService from "@/services/product.service";
import { Form, Field, ErrorMessage } from 'vee-validate';
import schema from '@/schemas/products/productUpdateSchema';

export default {
  name: "ProductEdit",
  components: {
    Form, Field, ErrorMessage
  },
  setup() {
    return {
      schema
    }
  },
  data() {
    return {
      id: 0,
      name: '',
      description: '',
      price: null,
      images: [],
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
      this.images = res.data.images
    },
    updateProduct() {
      const formData = new FormData()

      formData.append('name', this.name)
      formData.append('description', this.description)
      formData.append('price', this.price)

      //sending an empty array to clear all images
      if (this.images.length === 0) {
        formData.append('images[]', [])
      }
      for (let image of this.images) {
        if (image instanceof File) {
          formData.append('images[]', image)
        } else {
          formData.append('images[]', image.id)
        }
      }

      productService.update(formData, this.id).then(() => {
        this.$router.push({name: 'products.index'})
      }).catch(e => {
        this.errors = e.response.data.errors ?? [[e.response.data.message]]
      })
    },
    imageChosen(event) {
      this.images = []
      let selectedImages = event.target.files

      for(let i = 0; i <=2; i++) {
        if (selectedImages[i]) {
          this.images.push(selectedImages[i])
        }
      }

      for (let i = 0; i < this.product.length; i++) {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.$refs.image[i].src = reader.result;
        };

        reader.readAsDataURL(this.images[i]);
      }
    },
    priceInput(value) {
      console.log(this.$refs.priceInput.field)
      if(this.price && this.price.toString().includes('.')) {
        const newValueDigits = value.split('.')[1].length

        if (newValueDigits > 2) {
          // this.$refs["priceInput"].value = this.price
          return;
        }
      }
      this.price = value
    }
  },
  // watch: {
  //   price(newValue, oldValue) {
  //     if(this.price && this.price.toString().includes('.') && this.price.split('.')[1].length > 2) {
  //       this.price = oldValue
  //       console.log(oldValue)
  //     }
  //   }
  // },
  mounted() {
    this.fetchProduct()
  }
}
</script>

<style scoped>
.image_container {
  /*justify-content: space-evenly;*/
  padding-top: 10px;
  display: flex;
}
.preview_image {
  width: 33%;
}
</style>