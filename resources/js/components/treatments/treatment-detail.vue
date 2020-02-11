<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detalles de Tratamiento
            </div>
            <div class="card-body">
                <p>Costo</p>
                <p>2323.443</p>
                <p>precio</p>
                <p>2323</p>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" @click="saveTreatment">Crear</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {}
        },
        name: "treatment-detail",
        methods: {
            saveTreatment() {
                console.log('saveData');
            }
        }
    }
</script>
