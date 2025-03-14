<template>
    <div class="relative min-h-screen" style="background-color: #eff3f8;">
        
        <navbar/>
        <div v-if="render_app" class="mt-20">


            <router-view ></router-view>
        </div>
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
    