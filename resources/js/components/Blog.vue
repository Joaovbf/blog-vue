<template>
    <div class="d-flex flex-column vh-100">
        <form-post v-if="user !== null" class="mb-3" v-on:postCreated="showPost"></form-post>
        <div class="flex-1" style="overflow-y: auto; overflow-x: hidden">
            <div class="row">
                <div v-if="this.loading" class="col-12">
                    <spinner></spinner>
                </div>
                <post v-else v-for="(post,index) in posts" v-bind:post="post" v-bind:user="user"
                      v-bind:key="index"/>
            </div>
            <div class="alert alert-secondary" v-if="posts.length === 0 && !loading">Sem postagens</div>
        </div>
    </div>
</template>

<script>
    import FormPost from "./FormPost.vue"
    import Post from "./Post"
    import Spinner from "vue-simple-spinner"

    export default {
        data(){
            return({
                loading: true,
                posts: [],
                user: null,
            })
        },
        components: {
            FormPost,
            Post,
            Spinner
        },
        mounted(){
            this.init()
            this.getPosts()
        },
        methods: {
            init(){
                axios.get(route("usuario.logado")).then(response => this.user = response.data)
            },
            getPosts(){
                axios.get(route("postagem.index")).then(response => {
                    this.posts = response.data
                    this.loading = false
                })
            },
            showPost(post){
                this.posts.push(post)
            }
        }
    }
</script>

<style>

</style>
