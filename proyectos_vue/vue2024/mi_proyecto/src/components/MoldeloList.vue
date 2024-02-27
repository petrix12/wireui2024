<template>
    <div>
        <h2>Lista de modelos</h2>
        <ul>
            <li v-if="modelo in modelos" :key="modelo.id">{{ modelo.name }}</li>
        </ul>
    </div>
</template>

<!-- Composición API -->
<script>
import { defineComponent, onMounted } from 'vue'
import ModeloService from '@/services/ModeloService'

export default defineComponent({
    name: 'ModeloList',
    setup() {
        const service = new ModeloService()
        const modelos = service.getModelos()

        onMounted(async () => {
            await service.fetchAll()
        })

        return {
            modelos
        }
    },
})
</script>

<style scoped>
</style>