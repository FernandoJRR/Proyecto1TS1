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
    <v-form ref="form">
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
  }),
  methods: {
    async validate() {
      const { valid } = await this.$refs.form.validate();

      if (valid) alert("Form is valid");
    },
  },
};
</script>
