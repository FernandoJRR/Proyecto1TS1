<template>
  <v-container align="center">
    <h1
      style="
        font-family: 'Monaco', monospace;
        color: #fcd667;
        margin-bottom: 3vh;
      "
    >
      <img src="/icono-maiz.svg" width="30" /> uxaq ixim - login
      <img src="/icono-maiz.svg" width="30" />
    </h1>
    <v-form ref="form" @submit.prevent="submit">
      <v-text-field
        v-model="username"
        :rules="usernameRules"
        label="Username"
        prepend-icon="mdi-account"
        variant="outlined"
        style="width: 50%"
        required
      ></v-text-field>

      <v-text-field
        v-model="password"
        :prepend-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="passwordRules"
        :type="show ? 'text' : 'password'"
        label="Password"
        @click:prepend="show = !show"
        variant="outlined"
        style="width: 50%"
        required
      ></v-text-field>
      <v-btn type="submit">Login</v-btn>
      <h3 style="color:red">{{detalle}}</h3>
    </v-form>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    show: false,
    username: "",
    usernameRules: [(value) => !!value || "Username requerido!"],
    password: "",
    passwordRules: [(value) => !!value || "Password requerido!"],
    detalle: ""
  }),
  methods: {
    async validate() {
      const { valid } = await this.$refs.form.validate();

      if (valid) alert("Form is valid");
    },
    async submit(event) {
      let response = await $fetch(
        "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/conexion.php",
        {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
          },
          method: "POST",
          body: {
            tipo: "login",
            username: this.username,
            password: this.password
          },
        }
      );
      //Se comprueba si las credenciales son correctas
      if (response.error != null) {
        console.log("error, "+response.error);
        this.detalle = response.error;
      } else {
        const router = useRouter()
        localStorage.setItem("user", this.username);
        switch (response.tipo) {
          case 'Admin':
            break;
          case 'Autor':
            router.push('/admin/autor');
            break;
        }
      }
    },
  },
};
</script>
