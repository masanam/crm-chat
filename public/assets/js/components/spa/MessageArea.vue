<template>
  <div class="flex flex-col h-full">
    <ul class="list-none overflow-y-auto p-0">
      <li v-for="message in messages" :key="message.id" class="flex items-start p-2">
        <div v-if="message.user.id !== activeUser.id" class="mr-2">
          <img src="https://picsum.photos/200" alt="User avatar" class="rounded-full w-8 h-8" />
        </div>
        <div class="flex-grow">
          <div class="flex items-center">
            <span class="font-bold">{{ message.user.name }}</span>
            <span class="text-gray-400 text-sm ml-2">{{ message.timestamp }}</span>
          </div>
          <div class="mt-1">
            <span class="inline-block text-gray-700">{{ message.content }}</span>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    messages: Array,
    activeUser: Object
  }
};
</script>

<style scoped>
/* Gaya CSS tambahan untuk komponen area pesan */
</style>
