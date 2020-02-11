<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="car-header">
                        Detalles de Tratamiento
                    </div>
                    <div class="card-body">
                        <p>Costo</p>
                        <p>2323.443</p>
                        <p>precio</p>
                        <p>2323</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info" @click="saveTreatment">Creat</button>
                    </div>
                </div>
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
        methods:{
            saveTreatment(){
                console.log('saveData');
            }
        }
    }
</script>