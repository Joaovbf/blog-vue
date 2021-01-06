<template>
    <div class="col-md-6 col-12 mb-2">
        <div class="card">
            <div class="card-header">{{ post.titulo }}</div>
            <div class="card-body">
                {{ post.conteudo }}
                <hr>
                <a href="#" v-on:click.prevent="alternarComentarios">{{ mostrarComentarios ? "Esconder" : "Mostrar" }} Comentários</a>
                <div v-show="mostrarComentarios">
                    <div class="card card-body py-2 px-3 mb-2" v-bind:key="index" v-for="(comentario,index) in comentarios">
                        <p style="font-size: 12.5pt"><b>Autor:</b> {{ comentario.autor.name }}</p>
                        <p class="mb-0">{{ comentario.conteudo }}</p>
                    </div>
                    <div class="alert alert-secondary" v-if="this.comentarios.length === 0">
                        Faça o primeiro comentário
                    </div>
                    <div v-show="this.user != null">
                        <hr>
                        <form :action="route('comentario.store')" method="post" v-on:submit.prevent="adicionarComentario">
                            <div class="form-group mt-2">
                                <label for="comentario">Novo Comentário</label>
                                <textarea id="comentario" class="form-control" v-model="conteudo"></textarea>
                            </div>
                            <spinner v-if="this.sending"></spinner>
                            <button type="submit" class="btn btn-success" v-else>
                                Cadastrar Comentário
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Spinner from "vue-simple-spinner"

    export default {
        name: "post",
        props: ["post","user"],
        components:{
            Spinner
        },
        data(){
            return({
                token: document.head.querySelector("meta[name=csrf-token]"),
                sending: false,
                conteudo: "",
                comentarios: this.post.comentarios,
                mostrarComentarios: false
            })
        },
        methods:{
            alternarComentarios(){
                this.mostrarComentarios = !this.mostrarComentarios
            },
            adicionarComentario(event){
                const form = event.target
                console.log(form)
                this.sending = true
                axios.post(form.action,{
                    _token: this.token,
                    conteudo: this.conteudo,
                    post_id : this.post.id
                }).then(response => {
                    this.sending = false
                    this.comentarios.push(response.data)
                })
            }
        },
    }
</script>
