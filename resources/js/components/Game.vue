<template>
  <div class="bg-light-100 h-screen">
    <navigation></navigation>
    <div class="container shadow rounded px-2 sm:px-4 py-6 my-4 bg-light-50 w-full sm:max-w-3xl mx-auto pt-10 pb-20 mb-20">
      <div class="w-full mb-5 text-xl text-gray-800 leading-normal" v-if="bulls!==4">
        <div class="text-center text-4xl italic mb-4" v-if="!Boolean(errors.filter(v=>v==true).length)">Okay, guess my number!</div>
        <div class="text-center text-4xl italic mb-4" v-if="Boolean(errors.filter(v=>v==true).length)">Oops, you have duplicate digits.</div>
        <div class="number flex direction-row">
          <game-input v-for="(n, i) in numbers" :key="i" :error="errors[i]" @value:set="setValue(i, ...arguments)"></game-input>
        </div>

        <div class="text-lg" v-if="cows!==null">Cows: {{ cows }}</div>
        <div class="text-lg" v-if="bulls!==null">Bulls: {{ bulls }}</div>

        <div class="bg-success-300 flex justify-around" v-if="ready">
          <a class="rounded px-6 py-3 mt-4 bg-secondary-600 text-light-50 cursor-pointer" @click="checkNumber">Check Number</a>
        </div>
      </div>
      <div class="w-full mb-5 text-center text-gray-800 leading-normal" v-if="bulls==4">
        <div class="text-6xl">Won!</div>
        <div class="text-xl text-gray-400 mt-4">Congratulations, you found that my number is <span class="font-bold">{{ number }}</span>!</div>
        <div class="text-xl text-gray-400 mt-4">Tries: <span class="font-bold">{{ tries }}</span></div>
        <div class="flex justify-around mt-10 mt-4">
          <a href="/" class="rounded px-6 py-3 bg-secondary-600 text-light-50">Restart</a>
          <a href="/#/high-scores" class="rounded px-6 py-3 bg-primary-600 text-light-50">High Scores</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navigation from './layout/Navigation.vue'

import Login from './Login.vue'
import Game from './Game.vue'
import GameInput from './GameInput.vue'

export default {
  components: {
      Navigation,
      Login,
      Game,
      GameInput,
  },
  data: () => {
    return {
      numbers: [null, null, null, null],
      errors: [false, false, false, false],
      ready: false,
      cows: null,
      bulls: null,
      number: null,
      tries: null
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      if(this.checkLoggedIn()) {
        this.startNewGame();
      } else {
        this.$router.push('/login')
      }
    },
    startNewGame() {
      axios.get('/api/start')
      .then(res => {
        this.num = res.data;
      })
      .catch(err => {
        localStorage.removeItem('user');
        this.$router.push('login')
      })
    },
    setValue(i, val) {
      this.$set(this.numbers, i, Boolean( val ) ? Number( val ) : null);
      this.ready = this.isDone();
    },
    isDone() {
      return this.checkDuplicates() && this.checkEmptyValues(); 
    },
    checkEmptyValues() {
      const n = this.numbers;
      return n.filter(v=>Boolean(v)).length == 4;
    },
    checkDuplicates() {
      const n = this.numbers;
      n.forEach((v, i) => {
        this.$set(this.errors, i, n.filter(val=>val==v).length > 1 && Boolean(v));
      });
      return this.errors.filter(v=>Boolean(v)).length == 0;
    },
    checkNumber() {
      let number = Number(this.numbers.join(''));
      axios.get('/api/check-number/' + number)
      .then(res => {
        this.cows   = res.data.cows;
        this.bulls  = res.data.bulls;
        this.number = res.data.number ?? null;
        this.tries  = res.data.tries ?? null;
      })
    },
    checkLoggedIn() {
      return Boolean(localStorage.getItem('user'));
    },
  },
}
</script>
