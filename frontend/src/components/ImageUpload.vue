<template>
  <div class="mt-4">
    <file-pond
        name="image"
        ref="pond"
        label-idle="Click to choose images, or drag here..."
        accepted-file-types="image/jpg, image/jpeg, image/png"
        @addfile="handleProcessedFile"
        @warning="uploadError"
        allow-multiple="true"
        max-files="3"
    />
    <div
      v-if="errors"
    >
      <p
          class="error_msg"
        v-for="error in errors"
      >
        {{ error }}
      </p>
    </div>
  </div>
</template>

<script>
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';


import "filepond/dist/filepond.min.css";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

export default {
  name: "ImageUpload",
  components: {
    FilePond
  },
  props: {
    originalImages: {
      required: false,
      type: Array
    }
  },
  emits: [
    'imageUploaded'
  ],
  data() {
    return {
      errors: []
    }
  },
  methods: {
    handleProcessedFile(error, file) {
      if (error) {
        return;
      }

      this.$emit('imageUploaded', file.file)
    },
    uploadError(error) {
      if(error.body === 'Max files') {
        this.errors.push('You can upload no more than 3 images!')
      }
    }
  }
}
</script>

<style scoped>

</style>