<template>
  <div>
    <navigation></navigation>
    <div class="container w-full md:max-w-3xl mx-auto pt-10 pb-20 mb-20">
      <div class="w-full mb-5 md:px-6 text-xl text-gray-800 leading-normal">
        <h2 class="font-bold text-4xl mb-4">How to Play</h2>
        <p class="mb-3">Bulls and Cows is a 2 player game. One player thinks of a number, while the other player tries to guess it.</p>
        <ul class="list-disc mb-3 pl-6 text-sm">
          <li class="mt-2">The number to be guessed must be a 4 digit number, using only digits from 1 - 9, each digit atmost once. e.g. 1234 is valid, 0123 is not valid, 9877 is not valid, 9876 is valid.</li>
          <li class="mt-2">For every guess that the player makes, he gets 2 values - the number of bulls and the number of cows. 1 bull means the guess contains and the target number have 1 digit in common, and in the correct position. 1 cow means the guess and the target have 1 digit in common, but not in correct position. e.g. Let the target be 1234. Guessing 4321 will give 0 bulls and 4 cows. 3241 will give 1 bull and 3 cows. 4 bulls means you have won the game!</li>
          <li class="mt-2">The player gets 7 chances to correctly guess the entire number.</li>
        </ul>
        <p class="mb-3">P.S. If you still have doubts about the rules, check it over here: <a target="_blank" href="https://en.wikipedia.org/wiki/Bulls_and_Cows" class="text-primary-100 hover:text-primary-400">https://en.wikipedia.org/wiki/Bulls_and_Cows</a></p>
      </div>
    </div>
  </div>
</template>

<script>
import Navigation from './layout/Navigation.vue'

export default {
    components: {
        'navigation': Navigation,
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
