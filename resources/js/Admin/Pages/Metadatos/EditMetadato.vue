<template>
    <!-- Modal -->
    <div  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 modal-animation">
            <h2 class="text-2xl font-semibold mb-4">Editar metadato</h2>

            <div>
                <div class="mb-4">
                    <label for="keyword" class="block text-sm font-medium text-gray-700">Keyword *</label>
                    <input type="text" id="keyword" v-model="keyword" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Keyword">
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion *</label>
                    <input type="text" id="descripcion" v-model="descripcion" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="descripcion">
                </div>

                <div class="flex justify-end space-x-2">
                    <button @click="emit_event('close_modal')" type="button" class="px-4 py-2 bg-gray-300 duration-300 hover:bg-gray-400 text-black rounded-md cursor-pointer">Cancelar</button>
                    <button @click="edit_metadato" class="px-4 py-2 bg-theme-400 text-white rounded-md duration-300 hover:bg-theme-600 cursor-pointer">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    props: [
      'metadato_edit',
    ],
    data() {
        return {
            keyword: '',
            descripcion: '',
        };
    },
    methods: {
        edit_metadato() {
            const data = {
                'metadato_id': this.metadato_edit.id,
                'keyword': this.keyword,
                'descripcion': this.descripcion,
            }

            this.emit_event('edit_metadato', data);
        },
    },
    created(){
        this.keyword = this.metadato_edit.keyword;
        this.descripcion = this.metadato_edit.descripcion;
    }
};
</script>
