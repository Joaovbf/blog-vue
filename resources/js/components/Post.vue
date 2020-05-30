<template>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">{{ dados.titulo }}</div>
            <div class="card-body">
                {{ dados.conteudo }}
                <hr>
                <a href="#" v-on:click.prevent="alternarComentarios">Mostrar/Esconder Comentários</a>
                <div v-show="mostrarComentarios">
                    <div class="card card-body" v-bind:key="index" v-for="(comentario,index) in comentarios">
                        <h4><b>Autor:</b> {{ comentario.autor }}</h4>
                        <p><b>Conteúdo:</b> {{ comentario.conteudo }}</p>
                    </div>
                    <div v-show="authenticated">
                        <div class="form-group mt-2">
                            <label for="comentario">Novo Comentário</label>
                            <textarea id="comentario" class="form-control" v-model="conteudo"></textarea>
                        </div>
                        <button class="btn btn-success" v-on:click="adicionarComentario">Cadastrar Comentário</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "post",
        props: ["dados","authenticated"],
        data(){
            return({
                conteudo: "",
                comentarios: this.dados.comentarios,
                mostrarComentarios: false
            })
        },
        methods:{
            alternarComentarios(){
                this.mostrarComentarios = !this.mostrarComentarios
            },
            adicionarComentario(){

            }
        },
    }
</script>
