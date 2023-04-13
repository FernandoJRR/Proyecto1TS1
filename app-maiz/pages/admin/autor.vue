<template>
  <div>
    {{ usuario }}
    <h2>Articulos Escritos</h2>
    <v-table>
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
  </div>
</template>
<script setup>
  const { pending, data: articulos } = useLazyAsyncData('articulos', () => $fetch('http://localhost:4500/proyecto-maiz/server-maiz/db_conexion/administracion.php?articulos='+localStorage.getItem("user")));
</script>
<script>
export default {
  data: () => ({
    usuario: localStorage.getItem("user"),
  }),
};
</script>
