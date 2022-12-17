<template>
  <div v-if="isMounted">
    <div
      class="container"
      style="margin-top: 50px; margin-bottom: 50px"
      id="addproductsTableApp"
    >
      <div class="row" style="text-align: center">
        <div class="offset-md-3 col-md-6">
          <h2 id="title_create">EDIT PRODUCT</h2>
          <form v-on:submit.prevent="edit_activated">
            <!-- get title -->
            <div class="form-group">
              <label>Title</label>
              <input type="text" v-model="title" class="form-control" />
            </div>
            <!-- get description -->
            <div class="form-group">
              <label>Description</label>
              <input type="text" v-model="description" class="form-control" />
            </div>
            <!-- get amount -->
            <div class="form-group">
              <label>Price</label>
              <input type="number" v-model="price" class="form-control" />
            </div>
            <!-- get image -->
            <div class="form-group">
              <label>Image</label>
              <input
                type="file"
                accept="image/jpeg,image/png"
                @change="onFileChange"
                class="form-control"
              />
              <br v-if="image" />
              <p v-if="image"><b>PREVIEW IMAGE:</b></p>
              <img width="400" v-bind:src="image" />
            </div>
            <!-- submit button -->
            <input type="submit" class="btn btn-warning" value="EDIT PRODUCT" />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "edit",
  data() {
    return {
      title: "",
      description: "",
      price: 0,
      image: "",
      isMounted: false,
    };
  },
  props: {
    id_test: Number,
  },
  methods: {
    onFileChange(e) {
      const img = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(img);
      reader.onload = (e) => {
        this.image = e.target.result;
      };
    },
    edit_activated() {
      const data = {
        title: this.title,
        description: this.description,
        price: this.price,
        image: this.image,
      };
      axios.put(
        "http://restapi-products/products/update/" + this.id_test,
        data
      );

      alert("Product modified");
      location.reload();
    },
  },
  created() {
    axios
      .get("http://restapi-products/products/" + this.id_test)
      .then((response) => {
        this.title = response.data.title;
        this.description = response.data.description;
        this.price = response.data.price;
        this.image = response.data.image;
        this.isMounted = true;
      });
  },
};
</script>

<style></style>
