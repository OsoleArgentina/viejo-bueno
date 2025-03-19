<template>
    <div class="bg-white flex flex-col min-h-screen">
        <navbar/>
        <!-- TODO: container mx-auto -->
        <div class=" flex-grow mt-20">
            <router-view v-if="render_app" />
        </div>
        
        <footer-site></footer-site>
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
    