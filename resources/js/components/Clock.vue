<template>
  <Clock :blink="false" :displaySeconds="true" />
</template>
 
<script>
import Clock from 'vue-digital-clock'
 
export default {
  name: 'app',
  components: {
    Clock,
  },
}
</script>