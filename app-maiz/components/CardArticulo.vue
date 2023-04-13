<template>
  <v-card style="margin-left: 25%; margin-bottom: 1%" max-width="500">
    <v-card-text>
      <div>
        <nuxt-link
          :to="'/secciones/' + seccion"
          style="text-decoration: none; color: #71a92c"
        >
          {{ seccion }}
        </nuxt-link>
      </div>
      <p class="text-h4 text--primary">
        {{ titulo }}
      </p>
      <p>por: {{ autor }}</p>
      <div class="text--primary">
        {{ fecha }}
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn variant="text" color="teal-accent-4" @click="reveal = true">
        Ver Articulo
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  props: {
    titulo: String,
    slug: String,
    seccion: String,
    fecha: Date,
    autor: String,
    imagen: String,
  },
};
</script>
