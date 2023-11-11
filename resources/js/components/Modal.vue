<template>
    
    <!-- Modal -->
<div class="modal fade" :id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ titulo }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <slot name="conteudo"></slot>
      </div>
      <div class="modal-footer">
      <slot name="rodape">

      </slot>
        
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    props: ['id','titulo']
}
</script>