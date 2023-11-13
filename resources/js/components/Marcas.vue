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
        <template v-slot:alertas>

                <alert-component tipo="success" :detalhes="transacaoDetalhes"  mensagem="cadastro realizado com sucesso" v-if="transacaoStatus =='adicionado'"></alert-component>

                <alert-component tipo="danger" mensagem="Erro ao cadastra a marca" :detalhes="transacaoDetalhes"  v-if="transacaoStatus =='erro'"> </alert-component>

            </template>

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
            urlBase: 'http://localhost:8000/api/v1/marca',
            transacaoStatus:'',
            transacaoDetalhes: {},
            marcas: [],
        }
    },
    computed: {
            token(){
                let token = document.cookie.split(';').find(indice => {
                    return indice,indice.includes('token=')
                });
                token = token.split('=')[1];
                token = 'Bearer ' + token
                
                return token
            },
        },
    methods: {
        carregarLista(){
            let config = {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.get(this.urlBase,config)
            .then(response => {
                this.marcas = response.data
                console.log(this.marcas)
            })
            .catch(errors =>{
                console.log(errors)
            })
        },
       
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
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.post(this.urlBase,formData,config)
            .then(response =>{
                this.transacaoStatus = 'adicionado'
                //console.log(response)
                
                this.transacaoDetalhes ={
                    mensagem: 'ID do registro: ' +  response.data.id 
                } 
            })
            .catch(errors =>{
                this.transacaoStatus = 'erro'
                this.transacaoDetalhes = {
                    mensagem: errors.response.data.message,
                    dados: errors.response.data.errors
                }
                //console.log(errors)
                //errors.response.data.message
            })
            //pede a url, conteúdo e configuração da requisição
        },
        
    },
    //mounted - faz carregar automaticamente os metodos
    mounted(){
            this.carregarLista()
        }
}
</script>
 