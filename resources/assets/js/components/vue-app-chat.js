// Import komponen chat
import ChatMain from './spa/ChatMain.vue';

// Buat instance Vue dan mount ke elemen #app
const app = new Vue({
  components: {
    ChatMain
  },
  template: `
    <div class="container mx-auto px-4">
      <chat-main></chat-main>
    </div>
  `
}).$mount('#vue-chat');