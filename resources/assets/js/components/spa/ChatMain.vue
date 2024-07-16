<template>
  <div class="flex flex-col h-screen">
    <conversation-list
      :conversations="conversations"
      @conversation-selected="selectConversation"
      class="flex-grow overflow-y-auto"
    />
    <div class="flex items-center border-t border-gray-200">
      <message-input @message-sent="sendMessage" class="flex-grow" />
      <message-area :messages="messages" :active-user="activeUser" class="w-64" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'; // Import Axios di file ChatMain.vue

import ConversationList from './ConversationList.vue';
import MessageArea from './MessageArea.vue';
import MessageInput from './MessageInput.vue';

// Data state untuk percakapan, pengguna aktif, dan pesan
const state = {
  conversations: [],
  activeUser: null,
  messages: []
};

export default {
  components: {
    ConversationList,
    MessageArea,
    MessageInput
  },
  data() {
    return state;
  },
  methods: {
    // Memuat daftar percakapan
    loadConversations() {
      // Implementasi logika untuk memuat data percakapan dari API atau sumber data lainnya
    },
    // Memilih percakapan
    selectConversation(conversation) {
      this.activeUser = conversation.user;
      this.loadMessages(conversation.id);
    },
    // Memuat pesan dalam percakapan
    loadMessages(conversationId) {
      // Implementasi logika untuk memuat data pesan dari API atau sumber data lainnya
    },
    // Mengirim pesan baru
    sendMessage(message) {
      // Implementasi logika untuk mengirim pesan baru ke API atau sumber data lainnya
    }
  },
  mounted() {
    this.loadConversations();
  }
};
</script>

<style scoped>
/* Gaya CSS tambahan untuk komponen chat utama */
</style>
