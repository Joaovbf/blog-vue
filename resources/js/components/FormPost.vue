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
                titulo: '',
                conteudo: '',
                mensagem: { contexto: "", conteudo: [] }
            })
        },
        methods:{
            novoPost(event) {
                const form = event.target

                axios.post(form.action,{
                    titulo: this.titulo,
                    conteudo: this.conteudo,
                }).then(resposta => {

                    this.$emit("postCreated",resposta.data)

                    this.mensagem.contexto = "success"
                    this.mensagem.conteudo.push("Postagem cadastrada com sucesso")

                    this.titulo = ""
                    this.conteudo = ""
                }, reason => {
                    this.mensagem.contexto = "danger"
                    let errors = reason.response.data.errors
                    for(let key in errors)
                        this.mensagem.conteudo.push(errors[key].shift())
                })

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
