<template>
  <div>
    <v-btn variant="plain" prepend-icon="mdi-arrow-left" @click="volver">Volver al Blog</v-btn>
    <slot/>
  </div>
</template>
<script>
export default {
  methods: {
    volver() {
      const router = useRouter()
      localStorage.removeItem("user");
      router.push("/");
    }
  },
}
</script>
