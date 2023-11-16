<template>
    <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
            <card-component titulo="Busca de marcas">
                <template v-slot:conteudo>
                    <div class="row">
                            <div class="col mb-3">
                                
                    <input-container-component titulo="id da marca" id="inputId" id-help="idHelp"  texto-ajuda="Opcional informe o id da marca">

                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-model="busca.id">
                
                    </input-container-component>
                 
                    
                            </div>
                <div class="col mb-3">

                  <input-container-component titulo="Nome da marca" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional informe o nome da marca" >
                 <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="nome da marca"  v-model="busca.nome">
                
                    </input-container-component>

                </div>
                
                          </div>
                </template>
                <template v-slot:rodape>
                    <button type="submit" class="btn btn-primary btm-sm float-end" @click='pesquisar()'>Pesquisa</button >
                </template>
            </card-component>
            
             <!-- -------------------------------------- -->
             <card-component titulo="Relação de marcas">
               <template v-slot:conteudo>
                <table-component 
                :dados="marcas.data"
                :visualizar="{
                    visivel: true, dataToggle:'modal',dataTarget:'#modalMarcaVisualizar'}"
                :atualizar="{
                    visivel:true, 
                    dataToggle:'modal',dataTarget:'#modalMarcaAtualizar'}"
                :remover="{
                    visivel:true, dataToggle:'modal',dataTarget:'#modalMarcaRemover'

                }"
                :titulos= "{
                    id: {titulo: 'ID',tipo:'texto'},
                    nome: {titulo: 'Nome',tipo:'texto'},
                    imagem: {titulo: 'Imagem', tipo:'imagem'},
                    created_at: {titulo: 'Criação',tipo:'data'},
                }"
                ></table-component>
               </template>

               <template v-slot:rodape>
                <div class="row">
                    <div class="col-10"> 
                        <paginate-component>
                            <li v-for="l,key in marcas.links" :key='key'  :class="l.active ? 'page-item active' : 'page-item'" @click="paginacao(l)">
                                
                                <a class="page-link" href="#" v-html="l.label"></a>
                                
                            </li>
                        
                        
                        </paginate-component>
                    </div>

                    <div class="col">
                <button type="submit" class="btn btn-primary btm-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                    </div>
                   
                </div>
                
               
                </template>
             </card-component>
         </div>
     </div>

     <!--inicio do modal de inclusão de marca-->


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

          <!--fim do modal de inclusão de marca-->
          <!--inicio do modal visualização de marca-->
          <modal-component id="modalMarcaVisualizar" titulo="Visualizar marca">
            
            <template v-slot:alertas>

            </template>
            <template v-slot:conteudo>
                {{ $store.state.item }}
                <input-container-component titulo="10">
                <input type="text" class="form-control" :value="$store.state.item.id" disabled>
            </input-container-component>

            <input-container-component titulo="Nome da marca">
                <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
            </input-container-component>

            <input-container-component titulo="Imagem">
                <img :src="'/storage/' + $store.state.item.imagem" alt="" v-if="$store.state.item.imagem">
            </input-container-component>

            <input-container-component titulo="Data de criação">
                
                <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
            </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
          </modal-component>
          <!--fim do modal visualização de marca-->

          <!--inicio do modal remoção de marca-->
          <modal-component id="modalMarcaRemover" titulo="Remover marca">
            
            <template v-slot:alertas>
                <alert-component tipo="success" mensagem="Transação realizada com sucesso" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'sucesso'"></alert-component>

                <alert-component tipo="danger" mensagem="Erro na Transação " :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo v-if="$store.state.transacao.status !='sucesso'">
                {{ $store.state.item }}
                <input-container-component titulo="ID">
                <input type="text" class="form-control" :value="$store.state.item.id" disabled>
            </input-container-component>

            <input-container-component titulo="Nome da marca">
                <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
            </input-container-component>
    
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status !='sucesso'">Remover</button>
            </template>
          </modal-component>
          <!--fim do modal visualização de marca-->

        <!--inicio do modal atualização de marca-->

          <modal-component id="modalMarcaAtualizar" titulo="Atualizar Marca">
            <template v-slot:alertas>
                <alert-component tipo="success" mensagem="Atualização realizada com sucesso" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'sucesso'"></alert-component>

            <alert-component tipo="danger" mensagem="Erro na Transação " :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'erro'"></alert-component>

            </template>

        <template v-slot:conteudo>
            
            <div class="form-group">
            <input-container-component
             titulo="Nome da marca" id="NomeAtualizar" id-help="NomeAtualizarHelp" texto-ajuda="informe o nome da marca" >

                 <input type="text" class="form-control" id="NomeAtualizar" aria-describedby="NomeAtualizarHelp" placeholder="adicionar o nome da marca" v-model="$store.state.item.nome">
             
            </input-container-component>
        </div>

        <div class="form-group">
            <input-container-component titulo="Imagem" id="ImagemAtualizar" id-help="ImagemAtualizarHelp" texto-ajuda="Selecione uma imagem no formato png" >
            
                 <input type="file" class="form-control" id="ImagemAtualizar" aria-describedby="ImagemAtualizarHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                
            </input-container-component>
        </div>
       
        </template>

        <template v-slot:rodape>
        
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
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
            urlPaginacao:'',
            urlFIltro:'',
            transacaoStatus:'',
            transacaoDetalhes: {},
            marcas: { data: []},
            busca: { id:'', nome:''}
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
        atualizar(){
            //console.log('nome atualizado',this.$store.state.item.nome)
            //console.log('imagem',this.arquivoImagem);
            //console.log('verbo','patch');

            let formData = new FormData();
            formData.append('_method','patch');
            formData.append('nome',this.$store.state.item.nome);

            if(this.arquivoImagem[0]){
                formData.append('imagem',this.arquivoImagem[0]);
            }
            

            let url = this.urlBase +'/' +this.$store.state.item.id

            let config = {
                headers: {
                    'Content-Type': 'multipart/form',
                    'Accept': 'application/json',
                    'Authorization': this.token,
                }
            }
            axios.post(url,formData,config)
            .then(response => {
               // console.log('Atualizado',response);
               ImagemAtualizar.value ='';
               this.$store.state.transacao.status ='sucesso'
                this.$store.state.transacao.mensagem = 'Registro de marca atualizado com sucesso'
                this.carregarLista();
            }) 
            .catch(errors =>{
                //console.log('Erro de atualização',errors.response);
                this.$store.state.transacao.status ='erro'
                this.$store.state.transacao.mensagem = errors.response.data.message
                this.$store.state.transacao.dados = errors.response.data.errors
            })
        },
        remover(){
            let confimacao = confirm('Tem certeza que deseja remover esse registro')
            if (!confimacao){
                return false
            }
            let url = this.urlBase +'/'+ this.$store.state.item.id
            //console.log(url)
            let formData = new FormData();
            formData.append('_method','delete')

            let config = {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': this.token,
                    'Content-Type':'multipart/form-data',
                }
            }

            
            //console.log(this.$store.state.transacao)
            axios.post(url, formData, config)
            .then(response => {
                //console.log('registro removido com sucesso',response),
                this.$store.state.transacao.status ='sucesso'
                this.$store.state.transacao.mensagem = response.data.msg
                this.carregarLista()
            })
            .catch(errors => {
               // console.log('Houver um erro na tentativa de remoção do registro',errors);
                this.$store.state.transacao.status ='erro'
                this.$store.state.transacao.mensagem = errors.response.data.message
            })
           
        },
        pesquisar(){
            //console.log(this.busca)
            let filtro= '';
            for(let chave in  this.busca) {
                //console.log(chave, this.busca[chave])
                if(this.busca[chave]){
                    if (filtro != ''){
                    filtro += ';'
                }
                filtro += chave + ':like:' + this.busca[chave]
                }
                
                
            }
            if(filtro != ''){
                this.urlPaginacao ='page=1'
                 this.urlFIltro ='&filtro=' + filtro
            } else {
                this.urlFIltro =''
            }
            this.carregarLista()
          
        },
        paginacao(l){
            if(l.url){
                //this.urlBase = l.url //ajustando a url de consulta com  oparametro de pagina
                this.urlPaginacao = l.url.split('?')[1]
                this.carregarLista() //requisitando novamente os dados para nossa API
            }
        
    },
        carregarLista(){
             let url = this.urlBase +'?' + this.urlPaginacao + this.urlFIltro
             //console.log(url)
            let config = {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.get(url,config)
            .then(response => {
                this.marcas = response.data
               // console.log(this.marcas)
            })
            .catch(errors =>{
                console.log(errors)
            })
        },
       
        carregarImagem(e){
            this.arquivoImagem = e.target.files
        },
        salvar(){
            //console.log(this.nomeMarca,this.arquivoImagem[0]);
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
    //mounted - faz carregar automaticamente os métodos
    mounted(){
            this.carregarLista()
        }
}
</script>
 