<template>
  <v-snackbar
      v-model="snackbar"
  >
    {{ text }}

    <template v-slot:actions>
      <v-btn
          color="pink"
          variant="text"
          @click="closeSnackbar"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  computed: {
    snackbar() {
      return this.$store.state.snackbar.check;
    },
    text() {
      return this.$store.state.snackbar.text;
    }
  },
  methods: {
    closeSnackbar() {
      this.$store.commit('setSnackbar', {
        check:false,
        text: ""
      });
    }
  }
}
</script>
