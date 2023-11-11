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


     <modal-component id="modalMarca" titulo="Adicionar Marca">
        <template v-slot:conteudo>
            <div class="form-group">
            <input-container-component titulo="Nome da marca" id="novoNome" id-help="novoNomeHelp" texto-ajuda="informe o nome da marca" >

                 <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="adicionar o nome da marca" v-model="nomeMarca">
                {{ nomeMarca }}
            </input-container-component>
        </div>

        <div class="form-group">
            <input-container-component titulo="Imagem" id="novoImagem" id-help="novoImagemHelp" texto-ajuda="Selecione uma imagem no formato png" >
            
                 <input type="file" class="form-control" id="novoImagem" aria-describedby="novoImagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                 {{ arquivoImagem }}
            </input-container-component>
        </div>
        </template>

        <template v-slot:rodape>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
        </template>
        
        
     </modal-component>

 </div> 
 </template>

 <script>
export default {
    data() {
        return {
            nomeMarca:'',
            arquivoImagem: [],
            urlBase: 'http://localhost:8000/api/v1/marca'
        }
    },
    methods: {
        carregarImagem(e){
            this.arquivoImagem = e.target.files
        },
        salvar(){
            console.log(this.nomeMarca,this.arquivoImagem[0]);
            let formData = new FormData();
            formData.append('nome',this.nomeMarca);
            formData.append('imagem',this.arquivoImagem[0]);

            let config = {
                headers: {
                    'Content-type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
            axios.post(this.urlBase,formData,config)
            .then(response =>{
                console.log(response)
            })
            .catch(errors =>{
                console.log(errors)
            })
            //pede a url, conteúdo e configuração da requisição
        }
    }
}
</script>
 