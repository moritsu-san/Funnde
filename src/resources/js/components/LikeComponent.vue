<script setup>
  import { reactive } from 'vue'

  const { initialIsLikedBy, initialCountLikes, authorized, endpoint } = defineProps({
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
  });

  const state = reactive({
    countLikes: initialCountLikes,
    isLikedBy: initialIsLikedBy
  });

  const like = async() => {
    const res = await axios.put(endpoint);
    state.isLikedBy = true;
    state.countLikes = res.data.countLikes;
  };

  const unlike = async() => {
    const res = await axios.delete(endpoint);
    state.isLikedBy = false;
    state.countLikes = res.data.countLikes;
  };

  const handleClick = () => {
    if (!authorized) {
        alert('いいね機能はログイン中のみ使用できます')
        return
    }

    state.isLikedBy
      ? unlike()
      : like()
  };
</script>

<template>
  <button type="button" class="" >
    <i class="fa-solid fa-heart" :class="[state.isLikedBy ? 'heart-on' : 'heart-off']" @click="handleClick"></i>
  </button>
  {{ state.countLikes }}
</template>

