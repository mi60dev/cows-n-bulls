<template>
  <div>
    <navigation></navigation>
    <div class="container shadow rounded bg-secondary-100 px-8 py-6 my-4 w-full md:max-w-3xl mx-auto pt-10 pb-20 mb-20">
      <div class="text-xl text-gray-800 leading-normal p-5">
        <ol class="list-decimal pl-6">
          <li class="mb-4" v-for="(item, i) in list" :key="i">
            {{ item.user.username }} | 
            {{ item.tries }} tries |
            time: {{ item.time }} seconds
          </li>
        </ol>
      </div>
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
  data: () => {
    return {
      list: []
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      axios.get('/api/high-scores')
      .then((res) => {
        this.list = res.data;
      });
    }
  }
}
</script>
