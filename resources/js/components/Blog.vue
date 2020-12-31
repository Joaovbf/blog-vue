<template>
    <div>
        <form-post v-if="authenticated" class="mb-3" v-on:postCreated="postCreated"></form-post>
        <div>
            <div class="row">
                <post v-for="(post,index) in posts" v-bind:dados="post" v-bind:authenticated="authenticated"
                      v-bind:key="index"/>
            </div>
            <div class="alert alert-secondary" v-if="posts.length === 0">Sem postagens</div>
        </div>
    </div>
</template>

<script>
    import FormPost from "./FormPost.vue"
    import Post from "./Post"

    export default {
        props: ['authenticated','initialposts'],
        data(){
            return({
                posts: this.initialposts,
            })
        },
        components: {
            FormPost,
            Post
        },
        methods: {
            postCreated(post){
                this.posts.push(post)
            }
        }
    }
</script>

<style>

</style>
