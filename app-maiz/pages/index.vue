<template>
  <head>
    <title>portada - uxaq izim</title>
  </head>
  <div>Ultimos Articulos</div>
  <v-card
    style="margin-left: 25%; margin-bottom: 1%"
    max-width="500"
    v-for="item in articulos"
    :key="item.titulo"
  >
    <v-card-text>
      <div>
        <nuxt-link
          :to="'/secciones/' + item.seccion"
          style="text-decoration: none; color: #71a92c"
        >
          {{ item.seccion }}
        </nuxt-link>
      </div>
      <p class="text-h4 text--primary">
        {{ item.titulo }}
      </p>
      <p>por: {{ item.autor }}</p>
      <div class="text--primary">
        {{ item.fecha }}
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn variant="text" color="teal-accent-4" @click="reveal = true">
        Ver Articulo
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
const { pending, data: articulos } = useLazyAsyncData("articulos", () =>
  $fetch(
    "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?ultimos=true"
  )
);
</script>
