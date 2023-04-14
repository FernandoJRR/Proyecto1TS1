<template>
  <div>
    <div style="margin-left:25%">Usuario: {{ usuario }}</div>
    <br>

    <h2 style="margin-left:25%">Articulos Escritos</h2>
    <v-table style="width:50%; margin-left:25%">
      <thead>
        <tr>
          <th class="text-left">Titulo</th>
          <th class="text-left">Seccion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in articulos" :key="item.titulo">
          <td>{{ item.titulo }}</td>
          <td>{{ item.seccion }}</td>
        </tr>
      </tbody>
    </v-table>
    <br>

    <h2 style="margin-left:25%">Agregar Articulo</h2>
    <br>
    <v-form ref="form" @submit.prevent="submit" style="width:50%; margin-left:25%">
      <v-text-field
        v-model="titulo"
        label="Titulo"
        :rules="tituloRules"
        variant="outlined"
        style="width: 50%"
        required
      ></v-text-field>

      <v-text-field
        v-model="slug"
        label="Slug"
        :rules="slugRules"
        variant="outlined"
        style="width: 50%"
        required
      ></v-text-field>

      <v-select
        v-model="seccion"
        :items="secciones"
        :rules="seccionRules"
        label="Seccion"
        required
      ></v-select>

      <v-textarea
        v-model="contenido"
        label="Contenido"
        :rules="contenidoRules"
        required
      ></v-textarea>

      <v-btn type="submit">Publicar</v-btn>
      <h3 style="color: red">{{ error }}</h3>
      <h3 style="color: green">{{ exito }}</h3>
    </v-form>
  </div>
</template>
<script setup>
const { pending, data: articulos } = useLazyAsyncData("articulos", () =>
  $fetch(
    "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?articulos=" +
      localStorage.getItem("user")
  )
);
</script>
<script>
export default {
  data: () => ({
    usuario: localStorage.getItem("user"),
    secciones: ["Cultura","Ciencia","Genetica","Cultivo","Miscelanea","Historia"],

    titulo: "",
    tituloRules: [(value) => !!value || "Titulo requerido!"],
    slug: "",
    slugRules: [(value) => !!value || "Slug requerido!"],
    seccion: "",
    seccionRules: [(value) => !!value || "Seccion requerida!"],
    contenido: "",
    contenidoRules: [(value) => !!value || "Contenido requerido!"],
    error: "",
    exito: ""
  }),
  methods: {
    async validate() {
      const { valid } = await this.$refs.form.validate();

      if (valid) alert("Form is valid");
    },
    async submit(event) {
      let response = await $fetch(
        "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php",
        {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
          },
          method: "POST",
          body: {
            tipo: "publicacion",
            titulo: this.titulo,
            slug: this.slug,
            seccion: this.seccion,
            contenido: this.contenido,
            autor: localStorage.getItem("user"),
          },
        }
      );
      if (response.error != null) {
        console.log("error, "+response.error);
        this.error = response.error;
        this.exito = "";
      } else {
        this.$refs.form.reset();
        this.exito = "Publicacion exitosa";
        this.error = "";
      }
    },
  },
};
</script>
