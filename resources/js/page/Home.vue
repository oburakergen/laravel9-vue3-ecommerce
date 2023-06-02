<template>
    <v-container fluid>
      <v-row justify="center">
        <v-col
            lg="3"
            md="4"
            sm="12"
            v-for="(item, index) in items"
            :key="index">
          <v-card
              class="mx-auto"
              max-width="344"
          >
            <v-img
                :src="item.image"
                height="200px"
                cover
            ></v-img>

            <v-card-title>
              {{ item.name }}
            </v-card-title>

            <v-card-subtitle>
              {{ item.price.toFixed(2) }} ₺
            </v-card-subtitle>

            <v-card-actions>
              <v-btn
                  prepend-icon="mdi-plus"
                  color="light-blue-accent-4"
                  variant="text"
                  @click.prevent="addToCart(item)"
              >
                <template v-slot:prepend>
                  <v-icon color="success"></v-icon>
                </template>
                {{ item.quantity > 0 ? "Add To Card" : "Out Of Stock" }}
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
</template>

<script>
export default {
  name:"Home",
  data() {
    return {
      items: []
    }
  },
  mounted() {
    this.$store.dispatch('getProducts', 0).then((payload) => {
      this.items = payload;
    });
  },
  methods: {
    addToCart(item) {
      const _th = this.$store;

      this.$store.dispatch('addToBasket', {
        productId: item.id,
        quantity: 1,
        name: item.name
      }).then(function () {
        _th.commit('setDrawer');
      });
    }
  },
}
</script>