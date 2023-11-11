<template>
    <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
            <card-component titulo="Busca de marcas">
                <template v-slot:conteudo>
                    <div class="row">
                            <div class="col mb-3">
                                
                    <input-container-component titulo="id da marca" id="inputId" id-help="idHelp"  texto-ajuda="Opcional informe o id da marca">

                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                
                    </input-container-component>
                 
                    
                            </div>
                <div class="col mb-3">

                  <input-container-component titulo="Nome da marca" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional informe o nome da marca" >
                 <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="nome da marca">
                
                    </input-container-component>

                </div>
                
                          </div>
                </template>
                <template v-slot:rodape>
                    <button type="submit" class="btn btn-primary btm-sm float-end">Pesquisa</button>
                </template>
            </card-component>
            
             <!-- -------------------------------------- -->
             <card-component titulo="Relação de marcas">
               <template v-slot:conteudo>
                <table-component></table-component>
               </template>

               <template v-slot:rodape>
                <button type="submit" class="btn btn-primary btm-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                </template>
             </card-component>
         </div>
     </div>

     <!-- Button trigger modal -->


     <modal-component id="modalMarca" titulo="Adicionar Marca"></modal-component>

 </div> 
 </template>
 