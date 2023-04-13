<template>
  <div>
  Articulos de {{ seccion_actual }}
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
  </div>
</template>
<script setup>
  const route = useRoute();
  const seccion_actual = route.params.seccion;
  const { pending, data: articulos } = useLazyAsyncData("articulos", () =>
    $fetch(
      "http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?seccion="+seccion_actual
    )
  );
</script>
