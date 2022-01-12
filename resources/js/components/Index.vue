
<template>
  <div>
    <!--THIS IS NAV FOR NON-REGISTERED USERES-->
    <nav class="nav-container">
      <div class="container">
        <div class="logo">
         
        </div>
        <div class="links">
          <router-link class="" :to="{ name: 'Register' }" v-if="!isLoggedIn">
            <i class="fas fa-user-check"></i> &nbsp;Register
          </router-link>
          <router-link class="" :to="{ name: 'Editor' }" v-if="isLoggedIn">
            <i class="fas fa-address-card"></i> &nbsp; Dashboard
          </router-link>
          <a @click="logout" v-if="isLoggedIn">
            <i class="fas fa-user-check"></i> &nbsp; Logout</a
          >
        </div>
      </div>
    </nav>

    <div class="index-container" style="margin-top: 2vh">
      <div class="item-container">
        <div class="item-type"><span>CD</span></div>

        <div
          class="item-content"
          v-for="(product, index) in cdPaginate"
          :key="index"
        >
          <div class="item-select">
            <div class="product-detail-box">
              <span class="item-title">{{ product.title }}</span>
              <span class="item-details"
                >{{ product.firstName }} &nbsp; {{ product.mainName }}</span
              >
              <span class="item-details">${{ product.price }}</span>
              <span class="item-details"
                >length: &nbsp; {{ product.length }}</span
              >
            </div>
            <!-- <template v-for="user in allusers">
              <div v-if="user.id == product.user_id" :key="user.id">
                <img class="product-img" :src="user.img" alt="" />
              </div>
            </template> -->
          </div>
        </div>
        <div class="item-select mt-20">
          <button @click="cdprevPage"><i class="fas fa-arrow-left"></i></button>
          <button @click="cdnextPage">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>
      <div class="item-container">
        <div class="item-type"><span>BOOK</span></div>

        <div
          class="item-content"
          v-for="(product, index) in bookPaginate"
          :key="index"
        >
          <div class="item-select">
            <div class="product-detail-box">
              <span class="item-title">{{ product.title }}</span>
              <span class="item-details"
                >{{ product.firstName }} &nbsp; {{ product.mainName }}</span
              >
              <span class="item-details">${{ product.price }}</span>
              <span class="item-details"
                >length: &nbsp; {{ product.length }}</span
              >
            </div>
            <!-- <template v-for="user in allusers">
              <div v-if="user.id == product.user_id" :key="user.id">
                <img class="product-img" :src="user.img" alt="" />
              </div>
            </template> -->
          </div>
        </div>
        <div class="item-select mt-20">
          <button @click="bookprevPage">
            <i class="fas fa-arrow-left"></i>
          </button>
          <button @click="booknextPage">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <div class="item-container">
        <div class="item-type"><span>Game</span></div>

        <div
          class="item-content"
          v-for="(product, index) in gamePaginate"
          :key="index"
        >
          <div class="item-select">
            <div class="product-detail-box">
              <span class="item-title">{{ product.title }}</span>
              <span class="item-details"
                >{{ product.firstName }} &nbsp; {{ product.mainName }}</span
              >
              <span class="item-details">${{ product.price }}</span>
              <span class="item-details"
                >length: &nbsp; {{ product.length }}</span
              >
            </div>
            <!-- <template v-for="user in allusers">
              <div v-if="user.id == product.user_id" :key="user.id">
                <img class="product-img" :src="user.img" alt="" />
              </div>
            </template> -->
          </div>
        </div>
        <div class="item-select mt-20">
          <button @click="gameprevPage">
            <i class="fas fa-arrow-left"></i>
          </button>
          <button @click="gamenextPage">
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="index-container" style="margin-top: 5vh">
      <div class="item-container" v-if="!isLoggedIn">
        <div class="item-type"><span>LOGIN</span></div>

        <div class="form-container">
          <form action="#" @submit.prevent="handleLogin">
            <input
              type="email"
              name="email"
              class="form-control"
              v-model="formData.email"
              placeholder="Email Address"
            />
            <p style="color: red; margin: 0px 16px" v-if="errors.email">
              {{ errors.email[0] }}
            </p>

            <input
              type="password"
              name="password"
              class="form-control"
              v-model="formData.password"
              placeholder="Password"
            />
            <p style="color: red; margin: 0px 16px" v-if="errors.password">
              {{ errors.password[0] }}
            </p>

            <button type="submit">Sign In</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      formData: {
        email: "",
        password: "",
      },
      cdpageSize: 2,
      cdcurrentPage: 1,
      bookpageSize: 2,
      bookcurrentPage: 1,
      gamepageSize: 2,
      gamecurrentPage: 1,
      user: null,
      isLoggedIn: false,
      errors: [],
      allusers: "",
    };
  },
  methods: {
    handleLogin() {
      // send axios request to the login route
      axios.get("/sanctum/csrf-cookie").then((response) => {
        // axios.post('/login', this.formData).then(response => {
        //     this.getSecrets();
        // });

        axios
          .post("/api/login", this.formData)
          .then(() => {
            //login route checks for user and returns user if found

            //returned user is send to getProducts where products specific to the user is fetched.
            // this.getProducts();
            //redirect to editor and if admin is true redirect to admin
            this.isLoggedIn = true;
            console.log(this.isLoggedIn);
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      });
    },
    getProducts() {
      axios.get("/api/products").then((response) => {
        this.products = response.data;
      });
    },
    booknextPage: function () {
      if (this.bookcurrentPage * this.bookpageSize < this.sortedBooks.length)
        this.bookcurrentPage++;
    },
    bookprevPage: function () {
      if (this.bookcurrentPage > 1) this.bookcurrentPage--;
    },
    cdnextPage: function () {
      if (this.cdcurrentPage * this.cdpageSize < this.sortedCds.length)
        this.cdcurrentPage++;
    },
    cdprevPage: function () {
      if (this.cdcurrentPage > 1) this.cdcurrentPage--;
    },
    gamenextPage: function () {
      if (this.gamecurrentPage * this.gamepageSize < this.sortedGames.length)
        this.gamecurrentPage++;
    },
    gameprevPage: function () {
      if (this.gamecurrentPage > 1) this.gamecurrentPage--;
    },
    logout() {
      axios.post("/api/logout").then(() => {
        this.isLoggedIn = false;
      });
    },
  },
  computed: {
    sortedBooks: function () {
      return this.products.filter((row, index) => {
        if (row.type.localeCompare("book") == 0) return true;
      });
    },
    bookPaginate: function () {
      return this.sortedBooks.filter((row, index) => {
        let start = (this.bookcurrentPage - 1) * this.bookpageSize;
        let end = this.bookcurrentPage * this.bookpageSize;
        //if index matches start and end then all the value in the product will be returned
        if (index >= start && index < end) return true;
      });
    },
    sortedCds: function () {
      return this.products.filter((row) => {
        if (row.type.localeCompare("cd") == 0) return true;
      });
    },
    cdPaginate: function () {
      return this.sortedCds.filter((row, index) => {
        let start = (this.cdcurrentPage - 1) * this.cdpageSize;
        let end = this.cdcurrentPage * this.cdpageSize;
        //if index matches start and end then all the value in the product will be returned
        if (index >= start && index < end) return true;
      });
    },
    sortedGames: function () {
      return this.products.filter((row) => {
        if (row.type.localeCompare("game") == 0) return true;
      });
    },
    gamePaginate: function () {
      return this.sortedGames.filter((row, index) => {
        let start = (this.gamecurrentPage - 1) * this.gamepageSize;
        let end = this.gamecurrentPage * this.gamepageSize;
        //if index matches start and end then all the value in the product will be returned
        if (index >= start && index < end) return true;
      });
    },
    getUserImg: function ($id) {
      return this.allusers.filter((row) => {
        if (row.id == $id) return row.img;
      });
    },

    // sortedProducts:function() {

    //     return this.products.filter((row, index) => {
    //     // console.log(index + "checking the index of the filter method");
    //     let start = (this.currentPage-1)*this.pageSize;
    //     let end = this.currentPage*this.pageSize;
    //     //if index matches start and end then all the value in the product will be returned
    //     if(index >= start && index < end) return true;
    // });
    // }
  },
  beforeMount() {
    axios
      .get("/api/authenticated")
      .then((res) => {
        console.log(res);
        this.isLoggedIn = true;
      })
      .catch((error) => console.log("Error: ", error));

    axios.get("api/products_all").then((response) => {
      console.log(
        response.data.filter((row) => {
          if (row.type.localeCompare("book") == 0) return true;
        })
      );

      axios.get("api/users_all_fetch").then((response) => {
        console.log("users fetched");
        this.allusers = response.data;
      });
      this.products = response.data;
    });
  },
};
</script>

<style>
.form-row {
  margin-bottom: 8px;
}
</style>