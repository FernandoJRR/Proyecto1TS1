<template>
  <v-container class="mt-5">
    <h1
      style="
        font-family: 'Monaco', monospace;
        color: #fcd667;
        margin-left: 15em;
      "
    >
      <nuxt-link to="/" style="text-decoration: none; color: #fcd667">
        <img src="/icono-maiz.svg" width="30" /> uxaq ixim
        <img src="/icono-maiz.svg" width="30"
      /></nuxt-link>
    </h1>
    <br />
    <v-btn variant="plain" to="/">Portada</v-btn>
    <v-btn variant="plain" to="/secciones">Secciones</v-btn>
    <v-btn variant="plain" to="/acercade">Acerca de</v-btn>
    <v-btn variant="plain" @click="azar"
      >Azar! <img src="/icono-maiz.svg" width="20" />
    </v-btn>
    <v-btn variant="plain" style="margin-left: 53%" to="/admin">Login</v-btn>
    <v-divider />
  </v-container>
</template>
<script>
export default {
  methods: {
    azar() {
      fetch("http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?azar=true").then(
        response => {
          let valor = response.json();
          valor.then(
            resp=>{
              console.log(resp);
              const router = useRouter()
              router.push("/articulo/"+resp.slug);
            }
          );
        }
      ).catch();
    }
  },
}
</script>
