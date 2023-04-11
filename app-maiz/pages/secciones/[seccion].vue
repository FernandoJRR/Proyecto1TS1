<template>
  <div>
  {{ seccion_actual }}
  </div>
</template>
<script setup>
  const route = useRoute();
  const seccion_actual = route.params.seccion;
</script>
