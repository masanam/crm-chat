<template>
  <div class="flex items-center border-t border-gray-200">
    <input type="text" v-model="newMessage" placeholder="Enter your message" class="flex-grow px-4 py-2" />
    <button @click="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-md">Send</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newMessage: ''
    };
  },
  methods: {
    sendMessage() {
      if (this.newMessage) {
        // Implementasi logika untuk mengirim pesan baru ke API atau sumber data lainnya
        this.newMessage = '';
      }
    }
  }
};
</script>

<style scoped>
/* Gaya CSS tambahan untuk komponen input pesan */
</style>
