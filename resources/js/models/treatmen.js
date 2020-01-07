export default class Treatment {
    constructor() {
        this.name = '';
        this.products = [];
        this.price = 0;
        this.cost = 0;
    }

    addProduct(product){
        this.products.push(product);
    }


}