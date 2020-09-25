<template>
  <transition name="modal">
    <div class="modal-mask" :style="{ position:  position }">
      <div class="modal-wrapper">
        <div class="modal-container" :style="{ width: width + '%'}">
          
          <div class="modal-header" v-if="!custom_header">
            <h6  class="mb-0">              
              <slot name="header"></slot>
            </h6>                     
          </div>
          <slot v-else name="header"></slot>

          <div class="modal-body py-4 scroll-body">
            <slot name="body"></slot>
          </div>
          <div class="modal-footer">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style scoped>
  .scroll-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
  }
</style>

<script>
  export default {
    name: 'modal',
    methods:{
      hideModal() {
        this.$refs['my-modal'].hide()
      },
    },
    props: {
      width: {
        required: false
      },
      position: {
        required: false
      },
      custom_header: {
        default: false
      }
    }
  };
</script>