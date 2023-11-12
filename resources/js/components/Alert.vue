<template>
  <div :class="estilo" role="alert">
 {{ mensagem }}
 <hr>
<span v-if="detalhes.data.message"> 
    
    {{ detalhes.data.message }}

</span>
<span v-if="detalhes.data.id"> 
    
    {{ 'ID do registro: ' +  detalhes.data.id }}

</span>
 <br>
 <ul v-if="detalhes.data.errors">
    <li v-for="e, key in detalhes.data.errors" :key="key">
        {{ e[0] }}
    </li>
 </ul>
</div>
</template>

<script>

    export default {
       props: ['tipo','mensagem','detalhes'],
       computed: {
        estilo(){
            return 'alert alert-' + this.tipo
        }
       }
    }
</script>
