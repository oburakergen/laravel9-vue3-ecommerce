<template>
  <v-container>
    <v-table
        fixed-header
        height="500px"
    >
      <thead>
      <tr>
        <th class="text-left">
          Username
        </th>
        <th class="text-left">
          email
        </th>
        <th class="text-left">
          phone
        </th>
        <th class="text-left">
          total price X Qty
        </th>
        <th class="text-left">
          Status
        </th>
      </tr>
      </thead>
      <tbody>
      <tr
          v-for="item in items"
          :key="item.name"
      >
        <td>{{ item.name+ " " + item.lastname }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.phone }}</td>
        <td>{{ item.total_price + "-"+ item.total + "x"  }}</td>
        <td><v-btn @click.prevent="changeStatus(item.id)">{{ item.status }}</v-btn></td>
      </tr>
      </tbody>
    </v-table>
  </v-container>
</template>

<script>
export default {
  name:"Transaction",
  data() {
    return {
      items: []
    }
  },
  mounted() {
    this.$store.dispatch('transactionList').then((payload) => {
      this.items = payload;
    });
  },
  methods: {
    changeStatus(item) {
      this.$store.dispatch('updateTransaction', item).then((payload) => {
        this.items = payload;
      });
    }
  }
}
</script>