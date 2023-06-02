<template>
  <v-app>
    <basket />
    <navbar />
    <notify />
    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>

    <v-footer>
      <v-container class="text-overline d-flex align-center justify-space-between">
        <div>
          Copyright &copy; 2023 Burak ERGEN
        </div>

        <v-icon icon="mdi-vuetify" size="x-large" />
      </v-container>
    </v-footer>
  </v-app>
</template>

<script>
import Basket from "@/components/Basket.vue";
import Navbar from "@/components/Navbar.vue";
import Notify from "@/components/Notify.vue";

export default {
  name: 'App',
  components: {Notify, Navbar, Basket},
  mounted() {
    if (!this.$store.state.userId) {
      this.$store.commit('setUserId');
    }
  }
}
</script>
