<template>
  <head>
    <title>secciones - uxaq izim</title>
  </head>
  <div v-for="seccion in secciones">
    <nuxt-link
      :to="'/secciones/' + seccion"
      style="text-decoration: none; color: #71a92c"
    >
      {{ seccion }}
    </nuxt-link>
  </div>
</template>
<script setup>
const { pending, data: secciones } = useLazyAsyncData('secciones', () => $fetch('http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/conexion.php?atributo=secciones'))
const refresh = () => refreshNuxtData('secciones')
</script>
