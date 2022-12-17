<template>
  <div
    class="container"
    style="margin-top: 50px; margin-bottom: 50px"
    id="addproductsTableApp"
  >
    <div class="row" style="text-align: center">
      <div class="offset-md-3 col-md-6">
        <h2 id="title_create">CREATE PRODUCT</h2>
        <form v-on:submit.prevent="store">
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
          <!-- get price -->
          <div class="form-group">
            <label>Price</label>
            <input type="number" v-model="price" class="form-control" />
          </div>
          <!-- get image -->
          <div class="form-group">
            <label>Image</label>
            <input
              type="file"
              accept="image/*"
              @change="onFileChange"
              class="form-control"
            />
            <!-- preview image submitted -->
            <br v-if="image" />
            <p v-if="image"><b>PREVIEW IMAGE:</b></p>
            <img width="400" v-bind:src="image" />
          </div>
          <!-- submit button -->
          <input type="submit" class="btn btn-dark" value="ADD PRODUCT" />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Display_table from "./display_table.vue";

export default {
  data() {
    return {
      title: "",
      description: "",
      price: 0,
      image: "",
      ok: 0,
    };
  },
  methods: {
    onFileChange(e) {
      const img = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(img);
      reader.onload = (e) => {
        this.image = e.target.result;
        console.log(this.image);
      };
    },
    store() {
      const data = {
        title: this.title,
        description: this.description,
        price: this.price,
        image: this.image,
      };
      axios
        .post("http://restapi-products/products/add", data)
        .then((response) => console.log(response))
        .catch((error) => console.error("Error at post request", error));
      alert("Create product request submitted");
      location.reload();
    },
  },
  components: { Display_table },
};
</script>

<style>
.form-group {
  margin-bottom: 20px;
}
#title_create {
  margin-bottom: 35px;
  font-weight: bolder;
}
</style>
