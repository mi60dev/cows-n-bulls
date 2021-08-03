<template>
  <div>
    <div class="bg-light-100 h-screen">
      <navigation></navigation>
      <div class="container shadow rounded px-2 sm:px-4 py-6 my-4 bg-light-50 w-full sm:max-w-3xl mx-auto pt-10 pb-20 mb-20">
        <form @submit="submit">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
              Enter your username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              :class="error?'border-red':''"
              id="username" 
              type="text" 
              tlaceholder="Email"
              v-model="username"
              @keydown="clearForm"
            >
            <div class="text-red-500 mt-4 text-center">
              {{ error }}
            </div>
          </div>
          <div class="flex items-center justify-between">
            <button v-if="username" 
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Start Playing!
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Navigation from './layout/Navigation.vue'

import Login from './Login.vue'
import Game from './Game.vue'

export default {
  components: {
      Navigation,
  },
  data: () => {
    return {
      username: '',
      error: null,
    };
  },
  mounted() {
    this.checkLoggedIn();
  },
  methods: {
    clearForm() {
      this.error = null;
    },
    checkLoggedIn() {
      if( Boolean(localStorage.getItem('user')) ) {
        this.$router.push('/')
      }
    },
    submit(e) {
      e.preventDefault();
      this.error = null;
      if( Boolean( this.username ) ) {
        axios.post('/api/login', {username: this.username})
        .then(res => {
          localStorage.setItem('user', true);
          this.$router.push('/');
        })
        .catch(err => {
          this.error = Object.values(err.response.data.errors)[0][0];
        });
      } else {
        this.error = 'There is an error with your username.'
      }
    },
  }
}
</script>
