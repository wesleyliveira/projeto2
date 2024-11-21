<template>
    <div>
        <h1>Editar Cor</h1>

        <form @sumit.prevent="saveCor">
            <input v-model="cor.name" placeholder="Nome do Cor"/>
            <button type="submit">Salvar</button>
        </form>
    </div>
</template>

<script>
import api from "../api";

export default {
    props: ["id"],
    data(){
        return{
            cor: { name: ""},
        };
    },

    methods: {
        async fetchCor(){
            const response = await api.get(`/cor/${this.id}`);
            this.cor = response.data;
        },
        async saveCor(){
            await api.put(`/cor/${this.id}`, this.cor);
            this.$router.push("/"); //VOLTA A LISTA DE PRODUTOS
            },
        },
        mounted(){
            this.fetchCor();
        },
    };
</script>