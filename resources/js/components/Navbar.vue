<template>
  <v-app-bar :elevation="1">
    <v-container class="d-flex align-center py-0">
      <v-app-bar-title class="pl-0">
        <div class="d-flex align-center">
          <router-link to="/">Laravel Vue</router-link>
        </div>
      </v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn density="default" @click="closeDrawer"  min-width="60px" >,
        <v-icon>mdi-basket</v-icon>
        {{ count }}
      </v-btn>
      <v-btn density="default" @click.prevent="login" icon="mdi-login"  min-width="60px"  />
    </v-container>
  </v-app-bar>
</template>

<script>
export default {
  methods: {
    closeDrawer() {
      this.$store.commit('setDrawer');
    },
    login() {
      this.$router.push('/transaction');
    }
  },
  computed: {
    count() {
      return this.$store.getters.total;
    },
  },
}
</script>

<style lang="scss">
.header {
  padding: 5px;
}
.close-btn {

}
</style>