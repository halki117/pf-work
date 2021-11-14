<template>
  <div>
    <button
      type="button"
      class="btn btn-primary"
      @click="click"
      :class="{'btn-lg': IsClicked }"
    >
    aaa
    </button>
  </div>
</template>

<script>
  export default{
    data(){
      return {
        IsClicked: false
      }
    },
    methods: {
      click(){
        this.IsClicked = true
      },
    },
  }
</script>