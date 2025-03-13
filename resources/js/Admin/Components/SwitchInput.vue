<template>
    <div>
        <input
            :id="id"
            type="checkbox"
            class="peer hidden opacity-0"
            v-model="is_checked"
            @change="toggle_selection"
            :checked="is_checked"/>

        <label :for="id"
               class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-theme-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-checked:peer-focus-visible:outline-theme-500">
            <span class="sr-only"></span>
        </label>
    </div>
</template>
<script>
export default {
    props: [
        'id',
        'default_value',
    ],
    created() {
        this.is_checked = this.default_value
    },
    data() {
        return {
            is_checked: false
        }
    },
    methods: {
        toggle_selection() {
            if (this.is_checked) {
                this.emit_event('turn_on')
            } else {
                this.emit_event('turn_off')
            }
        },
        restore_state() {
            this.is_checked = this.default_value;
        }
    },
    watch: {
        default_value() {
            this.is_checked = this.default_value
        },
    },
};
</script>
