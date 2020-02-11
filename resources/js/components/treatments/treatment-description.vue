<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Productos del tratamiento
                    </div>
                    <div class="card-body">
                        <v2-table :data="products">
                            <v2-table-column label="Eliminar" prop="scope.row">
                                <template slot-scope="scope">
                                    <button @click="removeProduct(scope.row.id)"
                                            class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </template>
                            </v2-table-column>
                            <v2-table-column label="Nombre" prop="name"></v2-table-column>
                            <v2-table-column label="Código" prop="code"></v2-table-column>
                            <v2-table-column label="P. Unitario" prop="price">
                                <template slot-scope="scope">
                                    {{ scope.row.price | currency }}
                                </template>
                            </v2-table-column>
                            <v2-table-column label="Unidad" prop="unitName"></v2-table-column>
                            <v2-table-column label="Cantidad" prop="quantity"></v2-table-column>

                            <v2-table-column label="Editar" prop="scope.row">
                                <template slot-scope="scope">
                                    <button @click="editProduct(scope.row)"
                                            class="text-white btn btn-warning btn-sm">
                                        Editar
                                    </button>
                                </template>
                            </v2-table-column>
                        </v2-table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    let data = () => {
        return {}
    };
    export default {
        data,
        name: "treatment-description",
        components:{

        },
        methods:{
            removeProduct(product){
                console.log('remove product');
            },
            editProduct(product){
                console.log('edit product');
            }
        },
        computed:{
            products(){
                return this.$store.getters.getProductsTreatment;
            },

        }
    }
</script>

<style scoped>

</style>