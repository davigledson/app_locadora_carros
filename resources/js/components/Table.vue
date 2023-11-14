<template>
               <div>
               
                  <table class="table table-hover">
                        <thead>
                            <tr>
                            <th  v-for="t, key in titulos" :key="key" scope="col" >{{ t.titulo }}</th>

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
       props: ['dados','titulos'],
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
