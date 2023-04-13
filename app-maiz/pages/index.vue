<template>
  <head>
    <title>portada - uxaq izim</title>
  </head>
  <div>Ultimos Articulos</div>
  <CardArticulo
    v-for="item in articulos"
    :key="item.titulo"
    :titulo="item.titulo"
    :slug="item.slug"
    :seccion="item.seccion"
    :fecha="item.fecha"
    :autor="item.autor"
    :imagen="item.imagen"
  />
</template>

<script setup>
const { pending, data: articulos } = useLazyAsyncData("articulos", () =>
  $fetch(
    "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?ultimos=true"
  )
);
</script>
