<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Creación de tratamiento</div>
                    <div class="card-body">
                        <product-finder></product-finder>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <treatment-detail></treatment-detail>
            </div>
        </div>
        <TreatmentDescription></TreatmentDescription>
    </div>
</template>

<script>
    import ProductFinder from './product-finder';
    import TreatmentDescription from './treatment-description';
    import TreatmentDetail from './treatment-detail';

    export default {
        name: 'create-treatment',
        components: {
            ProductFinder,
            TreatmentDescription,
            TreatmentDetail
        }
    }
</script>
