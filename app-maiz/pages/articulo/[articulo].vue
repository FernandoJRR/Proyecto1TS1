<template>
  <div>
    <nuxt-link
      :to="'/secciones/' + articulo_actual.seccion"
      style="text-decoration: none; color: #71a92c"
    >
      {{ articulo_actual.seccion }}
    </nuxt-link>
    <p class="text-h4 text--primary">
      {{ articulo_actual.titulo }}
    </p>
    <p>por: {{ articulo_actual.autor }}</p>
    <div class="text--primary">
      {{ articulo_actual.fecha }}
    </div>
    <br>
    <p>{{articulo_actual.contenido}}</p>
  </div>
</template>
<script setup>
const route = useRoute();
const slug = route.params.articulo;
const { pending, data: articulo_actual } = useFetch(
  "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?articulo=" +
    slug
);
</script>
