<template>
  <div class="alert alert-error">
    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  name: 'error',
  props: {
    message: {
      type: String,
    },
  }
}
</script>
<style scoped>

</style>
