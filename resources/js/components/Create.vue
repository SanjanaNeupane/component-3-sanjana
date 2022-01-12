<template>
  <div class="grid-container">
    <HeaderComponent />
    <div class="menu-icon active" id="menu-icon">
      <i class="fas fa-bars"></i>
    </div>

    <!--
            Side menu content starts
        -->
    <Nav />
    <!--
            Side menu content ends
        -->
    <!--MAIN CONTENTS THE CONTENTS-->
    <main class="main">
      <section class="container mt-20">
        <div class="mt-20 mb-20" v-if="message != null">
          <div style="width: 100%; display: block" class="msg_success">
            {{ message }}
          </div>
        </div>
        <div class="item-container update-form">
          <div class="form-class">
            <form
              id="form1"
              class="form1"
              action=""
              @submit.prevent="addProduct"
            >
              <div class="item-type">
                <span>Create Product Form</span>
              </div>
              <div class="item-content">
                <input
                  class="item-user"
                  type="hidden"
                  id="User"
                  name="User"
                  v-model="product.user_id"
                />

                <input
                  class="item-title"
                  type="text"
                  id="title"
                  placeholder="title"
                  name="title"
                  v-model="product.title"
                />

                <p style="color: red; margin-bottom: 10px" v-if="errors.title">
                  {{ errors.title[0] }}
                </p>

                <input
                  class="item-title"
                  type="text"
                  id="FirstName"
                  placeholder="FirstName"
                  name="FirstName"
                  v-model="product.firstName"
                />

                <p
                  style="color: red; margin-bottom: 10px"
                  v-if="errors.firstName"
                >
                  {{ errors.firstName[0] }}
                </p>

                <input
                  class="item-title"
                  type="text"
                  id="MainName"
                  placeholder="MainName"
                  name="MainName"
                  v-model="product.mainName"
                />

                <p
                  style="color: red; margin-bottom: 10px"
                  v-if="errors.mainName"
                >
                  {{ errors.mainName[0] }}
                </p>

                <input
                  class="item-title"
                  type="number"
                  id="Price"
                  placeholder="Price"
                  name="Price"
                  v-model="product.price"
                />

                <p style="color: red; margin-bottom: 10px" v-if="errors.price">
                  {{ errors.price[0] }}
                </p>

                <input
                  class="item-title"
                  type="number"
                  id="Length"
                  placeholder="Length"
                  name="Length"
                  v-model="product.length"
                />

                <p style="color: red; margin-bottom: 10px" v-if="errors.length">
                  {{ errors.length[0] }}
                </p>
                <select name="type" id="type" v-model="product.type">
                  <option value="cd">CD</option>
                  <option value="book">BOOK</option>
                  <option value="game">Game</option>
                </select>
              </div>
            </form>

            <div class="item-select">
              <button form="form1" class="register_btn">CREATE</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import Nav from "./Nav";
import HeaderComponent from "./Header-component.vue";

export default {
  components: {
    Nav,
    HeaderComponent,
  },
  data() {
    return {
      product: {
        user_did: "",
        firstName: "",
        mainName: "",
        role: "",
        type: "",
        length: "",
        user_id: "",
      },
      user: {
        id: "",
        role: "",
      },
      isActive: false,
      message: null,
      errors: [],
    };
  },
  created() {
    console.log(`api/product/${this.$route.params.id}`);
    let id = this.$route.params.id;
    // axios.get('/api/product/edit'+id).then((response) => {
    //     console.log(response.data);
    //     this.products = response.data;
    // }).catch((error)=>console.log(error.response.status));
    axios.get(`/api/product/edit/${id}`).then((response) => {
      this.product = response.data;
    });
  },
  methods: {
    logout() {
      axios.post("/api/logout").then(() => {
        this.$router.push({ name: "Index" });
      });
    },
    addProduct() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/product/add", this.product)
          .then((response) => {
            console.log("Product added");
            this.message = "Product added successfully!";
          })
          .catch((error) => (this.errors = error.response.data.errors));
      });
    },
  },
  mounted() {
    axios
      .get("/api/user")
      .then((res) => {
        this.user = res.data; //sets the user details
        this.product.user_id = res.data.id;
      })
      .catch((error) => console.log("Error: ", error));
  },
};
</script>