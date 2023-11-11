<template>
    <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">Busca de Marcas</div>
 
                 <div class="card-body">
                          <div class="row">
                            <div class="col mb-3">
                    <label for="inputID" class="form-label">iD</label>
                    <input type="number" class="form-control" id="inputID" aria-describedby="idHelp" placeholder="ID da marca">
                    <div id="idHelp" class="form-text text-muted">Opcional informe o ID do registro</div>
                </div>
                <div class="col mb-3">
                    <label for="inputNome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="nome da marca">
                    <div id="nomeHelp" class="form-text text-muted">Opcional informe o nome da marca</div>
                </div>
                
                          </div>
                
               
                
       
                 </div>
                 <div class="card-footer">
                    <button type="submit" class="btn btn-primary btm-sm float-end">Pesquisa</button>
                </div>
             </div>
         </div>
     </div>
 </div> 
 </template>
 