<template>
    <div class="product-grid">
        <div class="header">
            <h1 class="product-list-title">Product List</h1>
            <div class="buttons">
                <button id="add-product-btn" @click="addProductListener">ADD</button>
                <button id="delete-product-btn">MASS DELETE</button>
            </div>
        </div>
        <div class="grid">
            <div
                    v-for="(product, index) in products"
                    :key="index"
                    class="product-card"
            >
                <input type="checkbox" class="delete-checkbox"/>
                <div class="product-info">
                    <p>{{ product.sku }}</p>
                    <p>{{ product.productType }}</p>
                    <p>{{ product.price }}</p>
                    <p><strong>{{product.attributeName}}:</strong> {{ product.attribute }}</p>
                </div>
            </div>
        </div>
        <footer class="footer">Simple Footer</footer>
    </div>
</template>

<script setup>

import {ref} from 'vue';
import { useRouter } from 'vue-router';

const products = ref([
    // Add your product objects here, e.g.:
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
    { sku: 'SKU123', productType: 'Book', price: 19.99, attribute: '0.5 kg' , attributeName: "Weight"},
]);

const router = useRouter();

function addProductListener() {
    router.push('/addProduct');
}

</script>

<style scoped>

.product-grid {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    justify-content: space-between;
}

.grid{
    height: 100%;
    overflow: auto;
    scroll-behavior: smooth;
    width: 75vw;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(13vw, 13vw));
    min-height: 25vh;
    grid-gap: 20px;
}

.product-card{
    display: grid;
    grid-template-rows: auto .8fr;
    border: 4px solid #282828;
    padding: 20px;
    background: #2f2e2e;
    border-radius: 10px;
}

.product-info {
    height: 100%;
    display: grid;
    padding: 10% 0;
    font-size: 20px;
    justify-content: center;
    align-content: space-evenly;
    justify-items: center;
}
/*
.product-info p {
    overflow: hidden;
    display: flex;
    align-items: center;
    flex-direction: column;
}
*/
.delete-checkbox {
    display: flex;
    align-items: center;
    margin-right: 10px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    overflow: hidden;
}

.delete-checkbox input[type="checkbox"] {
    display: none;
}

.delete-checkbox label {
    display: block;
    width: 100%;
    height: 100%;
    border: 2px solid #0e3128;
    border-radius: 4px;
    transition: all 0.2s ease-in-out;
}

.delete-checkbox input[type="checkbox"]:checked + label {
    background-color: #333;
    border-color: #333;
}

.delete-checkbox label:before {
    content: "";
    display: block;
    width: 10px;
    height: 10px;
    margin: 3px;
    border-radius: 2px;
    background-color: white;
    transition: all 0.2s ease-in-out;
}

.delete-checkbox input[type="checkbox"]:checked + label:before {
    transform: translateX(6px);
}

.product-info {
    margin-top: auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    width: 100%;
    border-bottom: 1px solid #ccc;
}

.product-list-title {
    margin: 0;
}

.buttons {
    display: flex;
}

button {
    margin: 0 5px;
    padding: 10px 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: white;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

button:hover {
    background-color: #333;
    color: white;
    border-color: #333;
}

.footer {
    border-top: 1px solid #ccc;
    margin-top: 2rem;
    text-align: center;
    width: 100%;
}
</style>
