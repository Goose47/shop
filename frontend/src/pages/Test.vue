<template>
  <div class="mt-4">
    <file-pond
        name="image"
        ref="pond"
        label-idle="Click to choose images, or drag here..."
        accepted-file-types="image/jpg, image/jpeg, image/png"
        @addfile="handleProcessedFile"
        @warning="warning"
        allow-multiple="true"
        max-files="3"
    />
  </div>
</template>

<script>
import vueFilePond from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import axios from 'axios';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

export default {
  name: "Test",
  components: {
    FilePond
  },
  data() {
    return {
      images: []
    }
  },
  methods: {
    handleProcessedFile(error, file) {
      if (error) {
        return;
      }

      // add the file to our images array
      console.log(file.file)
      this.images.unshift(file.file)
      // this.images = this.$refs.pond.getFiles()
    },
    warning(smth) {
      console.log(smth)
    },
    lol() {
      axios.post('http://localhost:8080/api/products', {
        name: 'name',
        description: '228228',
        price: '901.1',
        images: this.images
      }).then(res => {
        console.log(res)
      }).catch(e => {
        console.log(e)
      })
    }
  }
}
</script>

<style scoped>

</style>