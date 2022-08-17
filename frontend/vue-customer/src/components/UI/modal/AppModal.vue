<template>
  <div>
    <div
        @click="toggle"
    >
      <slot
          name="toggler"
      >
        <button>Toggle</button>
      </slot>
    </div>
    <div
        v-if="active"
        class="modal_background"
        @click="closeModal"
    >
      <div
          class="modal_content"
          @click.stop
      >
        <slot>
          <h5 class="modal-title">Modal title</h5>
        </slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppModal",
  data() {
    return {
      active: false
    }
  },
  methods: {
    toggle() {
      this.active = !this.active
    },
    closeModal() {
      this.active = false
    }
  }
}
</script>

<style scoped>
.modal_background {
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  background: rgba(0,0,0, 0.5);
  position: absolute;
  display: flex;
  z-index: 999;
}
.modal_content {
  margin: auto;
  background: white;
  border-radius: 12px;
  min-height: 50px;
  min-width: 300px;
  padding: 20px;
}
</style>