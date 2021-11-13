<template>
  <div>
    <button
      type="button"
      class="btn btn-primary"
      @click="click"
    >
    </button>
  </div>
</template>

<script>
  export default{
    methods: {
      click() {
        console.log('ok');
      },
    },
  }
</script>