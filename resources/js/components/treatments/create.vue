<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create treatment</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';

    export default {
        data(){
            let products = [];
          return{
              products
          }  
        },

        mounted() {
            this.getProducts()
        },
        methods:{
            async getProducts(){
                let apiProducts = await Axios.get('api/get-products');
                this.products = apiProducts.data.data;
            }
        }
        
    }
</script>
