<template>
  <div class="border border-light-200 bg-light-100 w-1/4 p-1 sm:p-2 m-1 sm:m-2"
      :class="error ? 'sm:bg-red-100' : ''"
  >
    <input 
      class="w-full border-light-200 text-2xl sm:text-8xl text-center" 
      type="text" 
      v-model="value" 
      min="1" max="9"
      oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*)\./g, '$1').charAt(0)"
     >
  </div>
</template>

<script>
export default {
  props: {
    error: Boolean,
  },
  data: () => {
    return {
      value: null,
    };
  },
  watch: {
    value: {
      handler: function(newValue, oldValue) {
        this.$emit('value:set', this.value)
      },
    },
  }
}
</script>
<style>
input:invalid {
  border: 1px solid red;
}
</style>
