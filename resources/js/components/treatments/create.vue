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
        </div>
    </div>
</template>

<script>
    import ProductFinder from './product-finder';

    export default {
        name:'create-treatment',
        components:{
            ProductFinder
        }
    }
</script>
