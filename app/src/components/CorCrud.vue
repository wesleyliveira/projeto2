<template>
  <div class="produto-list">
    <h1>Lista de Produtos</h1>

    <!--TABELA PARA EXIBIR OS produtoS-->
    <table class="produto-table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cor in cors" :key="cor.id" >
          <td>{{ cor.name }}</td>
          <td>
            <button @click="editCor(cor)">Editar</button>
            <button @click="deleteCor(cor.id)">Deletar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!--Oculta as informações do formulário limpando os campos para novas informações no formulário-->
    <button @click="showAddForm = !showAddForm">Adicionar Nova Cor</button> 

    <div v-if="showAddForm" class="add-form">
      <h3>Adicionar Novo Produto</h3>
      <!--"SUBMIT.PREVENT(EVITA QUE A PÁGINA SEJA RECARREGADA)"-->
      <form @submit.prevent="addCor">
        <input v-model="newCor.name" type="text" placeholder="Nome do Produto" required/>

        <button type="submit">Adicionar</button>
      </form>
    </div>

    <div v-if="editCorId !== null" class="add-form">
      <h3>Editar Produto</h3>
      <form @submit.prevent="saveEditCor">
        <input v-model="editCorData.name" type="text" placeholder="Nome do Produto" required />

        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default{
  data(){
    return {
      cors: [],
      newCor: {
        name: '',
      },
      showAddForm: false,
      editCorId: null,
      editCorData: {
        name: '',
      }
    };
  },
  mounted(){
    this.getCors();
  },
  methods: {
    getCors(){
      axios.get('http://localhost:8000/api/cor')
      .then(response => {
          // Acesse os dados no índice correto (assumindo que os hardwares estejam no índice 1)
        this.cors = response.data[1];
          // Atualiza a lista de hardwares
      })
      .catch(error => {
        console.log("Erro ao carregar produtos:",error);
      });
    },

    addCor(){
      axios.post('http://localhost:8000/api/cor', this.newCor)
      .then(response => {
        // Adiciona o novo hardware diretamente na lista
        this.cors.push(response.data);
        // Limpa o formulário
        this.newCor.name = '';
        this.showAddForm = false;
      })
      .catch(error => {
        console.log("Erro ao adicionar produto:",error);
      });
    },

    editCor(cor){
      this.editCorId = cor.id;
      this.editCorData.name = cor.name;
    },

    saveEditCor(){
      axios.put(`http://localhost:8000/api/cor/${this.editCorId}`, this.editCorData)
      .then(response => {
        //Encontra o índice do hardware que foi editado
        const index = this.cors.findIndex(cor => cor.id === this.editCorId);
        if(index !== -1){
          // Atualiza o hardware na lista
          this.cors[index] = response.data;
        }
        // Limpa o formulário
        this.editCorId = null;
        this.editCorData.name = '';
      })
      .catch(error => {
        console.log("Erro ao editar produto:",error);
      });
    },

    deleteCor(id) {
  console.log("Tentando deletar cor com ID:", id);
  axios.delete(`http://localhost:8000/api/cor/${id}`)
    .then(() => {
      console.log("Cor deletada com sucesso");
      this.cors = this.cors.filter(cor => cor.id !== id);
    })
    .catch(error => {
      console.error("Erro ao deletar cor:", error);
    });
    }
  }
}
</script>


<style scoped>
.produto-list {
  padding: 20px;
}

.produto-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.produto-table th, .produto-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.produto-table th {
  background-color: #f30000;
  font-weight: bold;
}

button {
  margin-right: 10px;
  padding: 5px 10px;
  cursor: pointer;
}

.add-form {
  margin-top: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  background-color: #463d3d;
}

form input {
  margin-bottom: 10px;
  padding: 8px;
  width: 100%;
  border: 1px solid #ddd;
}

form button {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
}
</style>
