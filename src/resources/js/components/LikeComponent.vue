<template>
    <div>
      <button
        type="button"
        class=""
      >
        <i class="fa-solid fa-heart"
           :class="[this.isLikedBy ? 'heart-on' : 'heart-off']"
           @click="clickLike"
        >
        </i>
      </button>
      {{ countLikes }}
    </div>
  </template>

  <script>

    export default {
      props: {
        initialIsLikedBy: {
          type: Boolean,
          default: false,
        },
        initialCountLikes: {
          type: Number,
          default: 0,
        },
        authorized: {
          type: Boolean,
          default: false,
        },
        endpoint: {
          type: String,
        },
      },
      data() {
        return {
          isLikedBy: this.initialIsLikedBy,
          countLikes: this.initialCountLikes,
        }
      },
      methods: {
        clickLike() {
          if (!this.authorized) {
            alert('いいね機能はログイン中のみ使用できます')
            return
          }

          this.isLikedBy
            ? this.unlike()
            : this.like()
        },
        async like() {
          const response = await axios.put(this.endpoint)
          this.isLikedBy = true
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
