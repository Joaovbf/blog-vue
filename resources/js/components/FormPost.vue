<template>
    <div>
        <div :class="'alert alert-'+mensagem.contexto" v-show="mensagem.conteudo.length > 0">
            <button type="button" class="close" aria-label="Close" v-on:click.prevent="excluirMensagem">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                <li v-for="(msg,index) in mensagem.conteudo" v-bind:key="index">{{ msg }}</li>
            </ul>
        </div>
        <form v-on:submit.prevent="novoPost" :action="route('postagem.store')" method="post">
            <input type="hidden" name="_token" v-model="token">
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input v-model="titulo" class="form-control" type="text" id="titulo" name="titulo">
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea v-model="conteudo" class="form-control" id="conteudo" name="conteudo"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'form-post',
        data(){
            return({
                token: document.head.querySelector("[name='csrf-token']").content,
                titulo: '',
                conteudo: '',
                mensagem: { contexto: "", conteudo: [] }
            })
        },
        methods:{
            novoPost(event) {
                const form = event.target
            },
            excluirMensagem(){
                this.mensagem = {
                    ...this.mensagem,
                    conteudo: []
                }
            }
        }
    }
</script>
