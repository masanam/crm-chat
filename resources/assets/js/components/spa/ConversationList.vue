<template>
  <ul class="list-none p-0">
    <li
      v-for="conversation in conversations"
      :key="conversation.id"
      @click="selectConversation(conversation)"
      class="flex items-center p-2 border-b border-gray-200"
    >
      <div class="flex-grow">
        <span class="font-bold">{{ conversation.user.name }}</span>
        <span class="text-gray-600">{{ conversation.latestMessage }}</span>
      </div>
      <span class="text-gray-400"> {{ conversation.unreadMessages }} unread </span>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    conversations: Array
  },
  methods: {
    selectConversation(conversation) {
      this.$emit('conversation-selected', conversation);
    }
  }
};
</script>

<style scoped>
/* Gaya CSS tambahan untuk komponen daftar percakapan */
</style>