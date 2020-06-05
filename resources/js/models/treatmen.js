export default class Treatment {
    constructor() {
        this.name = '';
        this.products = [];
        this.price = 0;
        this.cost = 0;
    }

    addProduct(product){
        console.log({product});
        let indexProduct = this.products.indexOf((item)=>{
            return item.id === product.id
        });
        
        console.log({indexProduct});

        if(indexProduct === -1){
            this.products.push(product);
        }
        else {
            this.products[indexProduct].quantity += product.quantity;
        }
    }

    getProducts(){
        return this.products;
    }


}