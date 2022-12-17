<template>
  <div v-if="edit_number != -1" id="some-form">
    <hr />
    <Edit_product :id_test="edit_number"></Edit_product>
    <hr />
  </div>

  <table
    class="table table-striped"
    style="width: 95%; margin: auto; margin-bottom: 100px"
  >
    <thead>
      <tr>
        <th>id</th>
        <th>title</th>
        <th>description</th>
        <th>price</th>
        <th>image</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products" :key="product.id">
        <td>{{ product.id }}</td>
        <td>{{ product.title }}</td>
        <td>{{ product.description }}</td>
        <td>{{ product.price }}</td>
        <td v-if="product.image">yes</td>
        <td v-else>no</td>
        <td>
          <button
            class="btn btn-primary"
            @click="editFunction(product.id)"
            style="margin: 5%"
          >
            Edit
          </button>
          <button class="btn btn-danger" @click="deleteFunction(product.id)">
            Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";
import Edit_product from "./edit_product.vue";

export default {
  name: "products",
  components: { Edit_product },
  data() {
    return {
      products: [],
      edit_number: -1,
    };
  },
  methods: {
    editFunction(id) {
      this.edit_number = id;
    },
    deleteFunction(id) {
      axios.delete("http://restapi-products/products/delete/" + id);
      alert("Product no. " + id + " deleted");
      location.reload();
    },
  },
  mounted() {
    axios
      .get("http://restapi-products/products/all")
      .then((response) => (this.products = response.data));
  },
};
</script>
