import Treatment from "../models/treatmen";

let treatment = new Treatment();

const types = {
    ADD_PRODUCT_TO_TREATMENT: 'ADD_PRODUCT_TO_TREATMENT',
};
const state = {
    treatment
};
const getters = {};
const actions = {
    addProductToTreatment({commit, state, dispatch}, product){
        commit(types.ADD_PRODUCT_TO_TREATMENT)
    }
};
const mutations = {
    [types.ADD_PRODUCT_TO_TREATMENT](state, product){
        state.treatment.addProduct(product);
    }
};

export default {
    state,
    getters,
    actions,
    mutations,
    treatment
}