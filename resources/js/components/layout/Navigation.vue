<template>
  <div>
    <nav class="bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <router-link class="block" to="/" exact>
                <img class="h-8 w-8" src="/img/cow.svg" alt="Workflow">
              </router-link>
            </div>
            <div class="">
              <div class="ml-10 flex items-baseline space-x-4">
                <router-link active-class="bg-gray-900 hover:bg-gray-700" class="text-white hover:text-gray-100 px-3 py-2 rounded-md text-sm font-medium" to="/high-scores" exact>
                  High Scores
                </router-link>
                <router-link active-class="bg-gray-900 hover:bg-gray-700" class="text-white hover:text-gray-100 px-3 py-2 rounded-md text-sm font-medium" to="/rules" exact>
                  Rules
                </router-link>
              </div>
            </div>
          </div>
          <div v-if="loggedIn">
            <span class="cursor-pointer text-white" @click="logout">Logout</span>
          </div>
        </div>
      </div>
    </nav>
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ title }} </h1>
      </div>
    </header>
  </div>
</template>

<script>
export default {
    components: {
    },
    props: {
    },
    data: () => {
        return {
          title: '',
          loggedIn: false
        }
    },
    mounted() {
      this.title = this.$route.name;
      this.loggedIn = Boolean( localStorage.getItem('user') );
    },
    updated() {
    },
    methods: {
      logout() {
        axios.get('/api/logout')
        .then(res => {
          localStorage.removeItem('user');
          this.$router.push('/')
        });
      }
    }
}
</script>
<style lang="scss">
</style>
