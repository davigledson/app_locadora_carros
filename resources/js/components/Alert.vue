<template>
  <div :class="estilo" role="alert">
 {{ mensagem }}
</div>
</template>

<script>
import { computed } from 'vue'
    export default {
       props: ['tipo','mensagem'],
       computed: {
        estilo(){
            return 'alert alert-' + this.tipo
        }
       }
    }
</script>
