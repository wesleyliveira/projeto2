// CREATEROUTER: FUNÇÃO PARA CRIAR UM NOVO OBJETO DE ROTEAMENTO
// CREATEWEBHISTORY: FUNÇÃO PARA CRIAR UM NOVO OBJETO DE HISTÓRICO DE NAVEGAÇÃO
import { createRouter, createWebHistory } from 'vue-router'

// IMPORTANDO OS COMPONENTES DAS ROTAS
import CorCrud from '../components/CorCrud.vue' 
import EditCor from '../components/EditCor.vue'


// ARRAY PARA DEFINR AS ROTAS DA APLICAÇÃO
const routes = [ 
  { path: '/', component: CorCrud},
  { path: '/edit/:id', component: EditCor, props:true},
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
