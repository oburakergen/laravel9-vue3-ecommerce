<template>
  <v-container fluid>
    <v-row>
      <v-col cols="7">
        <v-card
            :loading="this.loading"
            title="Create Order"
        >
          <v-card-text>
            <v-row>
              <v-col
                  cols="12"
                  md="12"
              >
                <v-text-field
                    v-model="form.name"
                    :rules="nameRules"
                    :counter="50"
                    label="First name"
                    required
                ></v-text-field>
              </v-col>

              <v-col
                  cols="12"
                  md="12"
              >
                <v-text-field
                    v-model="form.lastname"
                    :rules="nameRules"
                    :counter="50"
                    label="Last name"
                    required
                ></v-text-field>
              </v-col>

              <v-col
                  cols="12"
                  md="12"
              >
                <v-text-field
                    v-model="form.phone"
                    :rules="phoneRules"
                    :counter="20"
                    label="Phone"
                    required
                ></v-text-field>
              </v-col>

              <v-col
                  cols="12"
                  md="12"
              >
                <v-text-field
                    v-model="form.email"
                    :rules="emailRules"
                    :counter="50"
                    label="E-mail"
                    required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-btn @click.prevent="createOrder"  style="float:right; background: #4dd0e1">Buy</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="5">
        <v-row>
          <v-col cols="12" v-for="item in order" :key="order.id">
            <v-card-text>{{ item.name }}</v-card-text>
            <v-select
                v-model="test[item.quantity - 1]"
                label="Quantity"
                :items="options"
                @update:modelValue="changeQuantity(item)"
            ></v-select>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name:"Order",
  data() {
    return {
      test: [1,2,3,4,5,6,7,8,9,10],
      loading: false,
      valid: false,
      options: [1,2,3,4,5,6,7,8,9,10],
      nameRules: [
        value => {
          if (value) return true

          return 'Name is required.'
        },
        value => {
          if (value?.length <= 50) return true

          return 'Name must be less than 50 characters.'
        },
      ],
      phoneRules: [
        value => {
          if (value) return true

          return 'Phone is required.'
        },
        value => {
          if (value?.length <= 20) return true

          return 'Name must be less than 50 characters.'
        },
      ],
      emailRules: [
        value => {
          if (value) return true

          return 'E-mail is required.'
        },
        value => {
          if (/.+@.+\..+/.test(value) && value?.length <= 50) return true

          return 'E-mail must be valid.'
        },
      ],
      form: {
        name: "",
        lastname: "",
        email: "",
        phone: "+15005550010"
      }
    }
  },
  computed: {
    order() {
      return this.$store.state.cart;
    }
  },
  methods: {
    createOrder() {
      const _th = this;

      this.$store.dispatch('createOrder', this.form).then(function () {
        _th.$router.push("/");
      });
    },
    changeQuantity(item) {
      const _th = this.$store;

      this.$store.dispatch('addToBasket', {
        productId: item.id,
        quantity: 1,
        name: item.name
      }).then(function () {
        _th.commit('setDrawer');
      });
    }
  }
}
</script>