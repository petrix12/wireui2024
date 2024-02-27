import { ref } from 'vue'

class ModeloService {
    private modelos

    constructor() {
        this.modelos = ref([])
    }

    getModelos() {
        return this.modelos
    }

    async fetchAll() {
        try {
            const url = 'https:://mi_servicio/modelos'
            const response = await fetch(url)
            const json = await response.json()
            this.modelos.value = await json
        } catch(error) {
            console.log(error)
        }
    }
}

export default ModeloService