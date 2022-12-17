<template>
  <img alt="Vue logo" src="./assets/logo.png" id="logo" />

  <!-- CREATE PRODUCT -->
  <Create_product></Create_product>
  <!-- DISPLAY TABLE -->
  <Display_table></Display_table>
</template>

<script>
import Display_table from "./components/display_table.vue";
import Create_product from "./components/create_product.vue";

export default {
  name: "products",
  components: {
    Display_table,
    Create_product,
  },
  data() {
    return {};
  },
};
</script>

<style>
#logo {
  margin-top: 5%;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50px;
}
</style>
