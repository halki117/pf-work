<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none "
      @click="clickLike"
    >
      <i class="fas fa-heart mr-1 ml-5"
        :class="{'red-text': this.isLikedBy}"
      />
    </button>
    {{ countLikes }}
  </div>
</template>

<script>
  export default{
    props:{
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default:0
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data(){
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
      }
    },
    methods: {
      clickLike() {
        console.log('ok');
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        console.log(this.isLikedBy);
        const response = await axios.put(this.endpoint)
        this.isLikedBy = true
        console.log(this.isLikedBy);
        this.countLikes = response.data.countLikes
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
      },
    },
  }
</script>