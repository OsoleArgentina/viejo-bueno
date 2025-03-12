<template>
    <div id="toolbar-container">
        <span class="ql-formats">
            <!-- <select class="ql-font"></select> -->
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
    <!--        <button class="ql-direction" value="rtl"></button>-->
    <!--        <button class="ql-indent" value="-1"></button>-->
    <!--        <button class="ql-indent" value="+1"></button>-->
        </span>
    
    <!--    <span class="ql-formats">-->
    <!--        <select class="ql-color"></select>-->
    <!--        <select class="ql-background"></select>-->
    <!--    </span>-->
    
    <!--    <span class="ql-formats">-->
    <!--        <button class="ql-script" value="sub"></button>-->
    <!--        <button class="ql-script" value="super"></button>-->
    <!--    </span>-->
    
        <span class="ql-formats">
            <button class="ql-link"></button>
    <!--        <button class="ql-image"></button>-->
    <!--        <button class="ql-video"></button>-->
    <!--        <button class="ql-formula"></button>-->
        </span>
    </div>
    <div :ref="unique_ref"  class="text-editor">
    </div>
    </template>
    
    <script>
    import Quill from 'quill';
    
    export default {
        props: ['unique_ref', 'placeholder', 'initial_content'],
        mounted() {
            this.editor = new Quill(this.$refs[this.unique_ref], {
                theme: 'snow',
                debug: false,
                modules: {
                    // syntax: true,
                    toolbar: '#toolbar-container',
                },
                placeholder: this.placeholder
            })
    
            this.editor.on('text-change', this.handleTextEditorContentChange);
    
            if (this.initial_content) {
                this.editor.root.innerHTML = this.initial_content
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
                this.$emit('text_changed', this.content)
            },
        },
        methods: {
            handleTextEditorContentChange() {
                this.content = this.editor.root.innerHTML;
            },
        },
    }
    </script>
    