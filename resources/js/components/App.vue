<template>
  <div class="main">
    <the-navbar />
    <div class="pt-8">
      <router-view />
    </div>
  </div>
</template>

<script>
  export default {}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
.main {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
}
</style>