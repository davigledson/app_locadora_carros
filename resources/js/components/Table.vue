<template>
               <div>
               
                  <table class="table table-hover">
                        <thead>
                            <tr>
                            <th  v-for="t, key in titulos" :key="key" scope="col" >{{ t.titulo }}</th>
                                <th v-if="visualizar.visivel || atualizar || remover.visivel"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="obj, chave in dadosFiltrados" :key="chave">

                                <td v-for="valor, chaveValor in obj" :key="chaveValor">

                                    <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span> 

                                    <span v-if="titulos[chaveValor].tipo == 'data'">
                                    {{ '...' + valor }}
                                    </span> 

                                    <span v-if="titulos[chaveValor].tipo == 'imagem'">
                                        <img :src="'/storage/' + valor" width="30" height="30" alt="">
                                    </span> 
                                
                                </td>
                                <td  v-if="visualizar.visivel || atualizar || remover.visivel">
                                <button v-if="visualizar.visivel" class="btn btn-outline-primary btn-sm" :data-bs-target="visualizar.dataTarget" :data-bs-toggle="visualizar.dataToggle" @click="setStore(obj)"> Visualizar</button>

                                <button v-if="atualizar.visivel" class="btn btn-outline-primary btn-sm" :data-bs-target="atualizar.dataTarget" :data-bs-toggle="atualizar.dataToggle" @click="setStore(obj)"> Atualizar</button>

                                <button v-if="remover.visivel"  :data-bs-target="remover.dataTarget" :data-bs-toggle="remover.dataToggle" class="btn btn-outline-danger btn-sm" @click="setStore(obj)"> Remover</button>
                            </td>
                            </tr>
                            
                           
                            <!-- <tr v-for="obj in dados" :key="obj.id">
                                <template   v-for="valor, chave in obj"  :key="chave">
                                    <td v-if="titulos.includes(chave)">
                                       
                                        <span v-if="chave == 'imagem'">
                                        <img :src="'/storage/' + valor" width="30" height="30" alt="">
                                        </span>

                                        <span v-else>
                                            {{ valor }}
                                        </span>
                                    </td>
                                    
                                </template>
                             
                          
                            </tr> -->
                          <!-- se a chave não for imagem -->
                          <!-- <th scope="row">{{ m.id }}</th>
                            <td>{{ m.nome }}</td>
                            <td><img :src="'/storage/'+ m.imagem" width="30" height="30" ></td> -->
                        </tbody>
                        </table> 
                    </div>  
                    
</template>

<script>
    export default {
       props: ['dados','titulos','atualizar','remover','visualizar'],
       methods: {
        setStore(obj){
            this.$store.state.transacao.status ='';
            this.$store.state.transacao.mensagem ='';
            this.$store.state.transacao.dados ='';
            this.$store.state.item = obj;
            
        },
       },
       computed: {
        dadosFiltrados(){
           // console.log(this.dados)
            let campos = Object.keys(this.titulos);
            let dadosFiltrados = [];
            this.dados.map((item,chave) => {
                //console.log(chave,item);
                let itemFiltrado = {}
                campos.forEach(campo => {
                    //console.log(campo)
                    itemFiltrado[campo] = item[campo] //utilizar a sintaxe de array para criar um atributo dentro do objeto
                    //console.log(chave,item,campo)
                }) 
                dadosFiltrados.push(itemFiltrado)                   
                //console.log(itemFiltrado)

            })
           // console.log(campos);
           // console.log(this.dados)
            return dadosFiltrados
        }
       }
    }
</script>
