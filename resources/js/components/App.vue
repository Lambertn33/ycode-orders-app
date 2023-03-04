<template>
  <div class="main">
    <the-navbar />
    <div class="pt-8">
      <router-view />
    </div>
  </div>
</template>

<script>
  export default {
    created() {
      // generate random number to be used as user ID and to be used to identify user cart from DB      
      if (!this.$store.getters.getUser) {
        const randomNumber = Math.floor(Math.random() * 100) + 1;
        this.$store.dispatch('setUser', randomNumber);
      }
    }
  }
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
.main {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
}
</style>