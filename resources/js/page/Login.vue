<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card
            :loading="this.loading"
            title="Login"
        >
         <form @submit.prevent="createAuth">
           <v-card-text>
             <v-row>
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
               <v-col
                   cols="12"
                   md="12"
               >
                 <v-text-field
                     v-model="form.password"
                     type="password"
                     :rules="passwordRules"
                     label="Password"
                     required
                 ></v-text-field>
               </v-col>
             </v-row>
           </v-card-text>
           <v-card-actions>
             <v-btn type="submit" style="float:right; background: #4dd0e1">Login</v-btn>
           </v-card-actions>
         </form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name:"Order",
  data() {
    return {
      loading: false,
      valid: false,
      passwordRules: [
        value => {
          if (value) return true

          return 'Password is required.'
        },
        value => {
          if (value?.length > 7) return true

          return 'Name must be more than 7 characters.'
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
        email: "admin@admin.com",
        password: "password",
        device_name: "",
      }
    }
  },
  mounted() {
    if (this.$store.getters.auth) {
      return this.$router.push("/transaction");
    }
  },
  methods: {
    createAuth() {
      this.form.device_name = navigator.userAgent;
      const _th = this;

      this.$store.dispatch("createAuth",this.form).then((response) => {
        this.$store.dispatch("userMe").then(() => {
          response && _th.$router.push("/transaction")
        })
      });
    }
  }
}
</script>