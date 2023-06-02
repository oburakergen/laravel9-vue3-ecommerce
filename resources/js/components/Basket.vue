<template>
  <v-navigation-drawer
      class="bg-deep-purple"
      theme="dark"
      v-model="drawer"
      temporary
  >
    <v-row>
      <v-col cols="8">
        <v-card-text class="header">
          Shopping Card({{ count }})
        </v-card-text>
      </v-col>
      <v-col cols="4">
        <v-btn icon="mdi-close"  style="min-width: 80px;float: right;" variant="plain" @click="closeDrawer"></v-btn>
      </v-col>

    </v-row>
    <v-divider></v-divider>
      <v-list color="transparent" density="compact" nav>
        <v-list-item
            v-for="product in products" :key="product.id"
            :prepend-avatar="product.image"
            :title="product.name"
            :subtitle="product.price.toFixed(2) + '₺ X ' + product.quantity"
        >
        </v-list-item>
      </v-list>

    <template v-slot:append>
      <div class="pa-2">
        <v-row>
          <v-col cols="12">
            <v-text-field>
              Total Price {{ total }} ₺
            </v-text-field>
          </v-col>
          <v-col cols="12">
            <v-btn block @click.prevent="clear" density="default" width="100%">
              Clear
            </v-btn>
          </v-col>
          <v-col cols="12">
            <v-btn block width="100%" @click.prevent="redirectCheckout">
              Checkout
            </v-btn>
          </v-col>
        </v-row>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
export default {
  computed: {
    drawer() {
      return this.$store.state.drawer;
    },
    count() {
      return this.$store.getters.total;
    },
    total() {
      return this.$store.getters.totalPrice;
    },
    products() {
      return this.$store.state.cart
    }
  },
  methods: {
    closeDrawer() {
      this.$store.commit('setDrawer');
    },
    clear() {
      const _th = this;

      if(_th.$store.getters.total === 0) {
        return true
      } else {
        this.$store.dispatch('clearBasket').then(function () {
          _th.$store.commit('setDrawer');

          if (_th.$route.href === "/order") {
            _th.$router.push("/");
          }
        });
      }
    },
    redirectCheckout() {
      this.$store.commit('setDrawer');
      this.$router.push("/order");
    },
  }
}
</script>

<style lang="scss">
.v-navigation-drawer--left {
  width: 40% !important;

  .header {
    padding: 13px;
    font-size: 16px;
    font-weight: 600;
  }

  .v-list-item-title {
    font-size: 16px;
  }
  .v-list-item-subtitle {
    font-size: 14px;
  }
}
@media only screen and (max-width: 600px) {
  .v-navigation-drawer--left {
    width: 100% !important;
  }
}
</style>