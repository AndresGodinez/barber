<template>
    <div>
        <div class="col-md-12">
            <vue-autosuggest
                    v-model="query"
                    :suggestions="filteredOptions"
                    @focus="focusMe"
                    @input="onInputChange"
                    @selected="onSelected"
                    :get-suggestion-value="getSuggestionValue"
                    :input-props="{id:'autosuggest__input', placeholder:'Seleccione el producto'}">
                <div slot-scope="{suggestion}" style="display: flex; align-items: center;">
                    <div style="{ display: 'flex', color: 'navyblue'}">{{suggestion.item.name}}</div>
                </div>
            </vue-autosuggest>

            <button class="btn btn-info">Buscar</button>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';
    import {VueAutosuggest} from 'vue-autosuggest';

    export default {
        data() {
            let products = [];
            return {
                products,
                query: "",
                selected: "",

            }
        },
        components: {
            VueAutosuggest
        },

        mounted() {
            this.getProducts()
        },
        computed: {
            filteredOptions() {
                return [
                    {
                        data: this.products.filter(option => {
                            return option.name.toLowerCase().indexOf(this.query.toLowerCase()) > -1;
                        })
                    }
                ];
            }
        },
        methods: {
            async getProducts() {
                let apiProducts = await Axios.get('api/get-products');
                this.products = apiProducts.data.data;
                console.log(this.products);
            },

            onSelected(item) {
                this.selected = item.item;
                console.log({'se':this.selected});
                this.$store.dispatch('addProductToTreatment', this.selected);
            },
            onInputChange(text) {
                // event fired when the input changes
                console.log(text)
            },
            /**
             * This is what the <input/> value is set to when you are selecting a suggestion.
             */
            getSuggestionValue(suggestion) {
                return suggestion.item.name;
            },
            focusMe(e) {
                console.log(e) // FocusEvent
            }
        }
    }
</script>

<style>
    li {
        margin: 0 0 0 0;
        border-radius: 5px;
        padding: 0.75rem 0 0.75rem 0.75rem;
        display: flex;
        align-items: center;
    }
    li:hover {
        cursor: pointer;
    }
</style>