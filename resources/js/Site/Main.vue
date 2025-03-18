<template>
    <div class="relative min-h-screen bg-white">
        
        <navbar/>

        <div  class="mt-28">


            <router-view v-if="render_app" />
        </div>
        <!-- <footer-site></footer-site> -->
    </div>
</template>
<script>
export  default {
    created() {
        this.render_app = true
    },
    data() {
        return {
            render_app: false
        }
    },
}
</script>
    