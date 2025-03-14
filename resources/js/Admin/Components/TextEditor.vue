<template>
    <div>
        <div :id="'toolbar-container-' + unique_ref">
            <span class="ql-formats">
                <select class="ql-size"></select>
            </span>
            <span class="ql-formats">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
                <select class="ql-align"></select>
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-link"></button>
            </span>
        </div>
        <div :ref="unique_ref" class="text-editor"></div>
    </div>
</template>

<script>
import Quill from 'quill';

export default {
    props: ['unique_ref', 'placeholder', 'initial_content'],
    mounted() {
        this.initializeEditor();
    },
    destroyed() {
        if (this.editor) {
            this.editor.destroy();
        }
    },
    data() {
        return {
            editor: null,
            content: ''
        }
    },
    watch: {
        content() {
            this.$emit('text_changed', this.content);
        },
    },
    methods: {
        initializeEditor() {
            const toolbarId = '#toolbar-container-' + this.unique_ref;
            
            this.editor = new Quill(this.$refs[this.unique_ref], {
                theme: 'snow',
                debug: false,
                modules: {
                    toolbar: toolbarId,
                },
                placeholder: this.placeholder
            });

            if (this.initial_content) {
                this.editor.root.innerHTML = this.initial_content;
            }

            this.editor.on('text-change', this.handleTextEditorContentChange);
        },
        handleTextEditorContentChange() {
            this.content = this.editor.root.innerHTML;
        },
    },
}
</script>

<style scoped>
.text-editor {
    min-height: 200px; /* Ajusta el tamaño mínimo según tus necesidades */
    max-height: 400px; /* Limita la altura máxima */
    overflow-y: auto; /* Muestra el scroll si el contenido excede el máximo */
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
}
</style>
