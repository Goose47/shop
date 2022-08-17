<template>
  <div class="mt-4">
    <file-pond
        name="image"
        ref="pond"
        label-idle="Click to choose images, or drag here..."
        @addfile="handleUploadedFile"
        @removefile="handleRemovedFile"
        @warning="uploadError"
        allow-multiple="true"
        max-files="3"
        credits="false"
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
    'imageUploaded',
    'imageRemoved'
  ],
  data() {
    return {
      images: [],
      errors: []
    }
  },
  methods: {
    handleUploadedFile(error, file) {
      if (error) {
        return;
      }

      this.$emit('imageUploaded', this.getImageModel(file))
    },
    handleRemovedFile(error, file) {
      this.$emit('imageRemoved', this.getImageModel(file))
    },
    uploadError(error) {
      this.errors = []
      if(error.body === 'Max files') {
        this.errors.push('You can upload no more than 3 images!')
      }
    },
    getImageModel(file) {
      return {
        id: file.getMetadata('id') ?? file.id,
        file: file.file
      }
    }
  },
  watch: {
    originalImages() {
      if (this.originalImages && this.originalImages.length > 0) {
        for (let image of this.originalImages) {
          this.$refs.pond.addFile(image.path).then(fileItem => {
            fileItem.setMetadata('id', image.id)
          })
        }
      }
    }
  }
}
</script>

<style scoped>

</style>

<!--accepted-file-types="image/jpg, image/jpeg, image/png"-->