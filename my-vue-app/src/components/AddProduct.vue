<template>
    <div class="add-product">
        <div class="header">
            <h1 class="product-list-title">Add Product</h1>
            <div class="buttons">
                <button id="add-product-btn" @click="saveProduct">Save</button>
                <button id="delete-product-btn" @click="goBack">Cancel</button>
            </div>
        </div>
        <div class="wrapper" id="product_form">
            <div class="input-container">
                <div class="input-fields">
                    <label for="sku">SKU</label>
                    <input id="sku" type="text" v-model="form.sku" placeholder="SKU"/>

                    <label for="name">Name</label>
                    <input id="name" type="text" v-model="form.name" placeholder="Name"/>

                    <label for="price">Price ($)</label>
                    <input id="price" type="number" v-model="form.price" placeholder="Price ($)"/>

                </div>
                <div class="type-select">
                    <label for="productType">Type Switcher</label>
                    <select id="productType" v-model="form.type">
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
            </div>
            <div class="product-switch">
                <div class="select-choice" v-if="form.type === 'DVD'">
                    <label for="size">Size (MB)</label>
                    <input id="size" type="number" v-model="form.size" placeholder="Size (MB)"/>
                    <p>Please, provide size</p>
                </div>
                <div class="select-choice" v-if="form.type === 'Book'">
                    <label for="weight">Weight</label>
                    <input id="weight" type="number" v-model="form.weight" placeholder="Weight"/>
                    <p>Please, provide weight</p>
                </div>
                <div class="select-choice" v-if="form.type === 'Furniture'">
                    <label for="height">Height</label>
                    <input id="height" type="number" v-model="form.height" placeholder="Height"/>

                    <label for="width">Width</label>
                    <input id="width" type="number" v-model="form.width" placeholder="Width"/>

                    <label for="length">Length</label>
                    <input id="length" type="number" v-model="form.length" placeholder="Length"/>
                    <p>Please, provide dimensions</p>
                </div>
            </div>
        </div>
        <footer class="footer">Simple Footer</footer>
    </div>
</template>


<script setup>
import {ref} from "vue";
import {useRouter} from "vue-router";
import { API_BASE_URL } from '@/config';

const form = ref(data());

function data() {
    return {
        sku: "",
        name: "",
        price: 0,
        type: "DVD",
        size: 0,
        height: 0,
        width: 0,
        length: 0,
        weight: 0,
    };
}

const router = useRouter();
function goBack() {
    router.push('/');
}

async function saveProduct() {
    const url = `${API_BASE_URL}/products/create`;
    let requestBody = {};

    switch (form.value.type) {
        case "DVD":
            requestBody.attribute = form.value.size;
            break;
        case "Book":
            requestBody.attribute = form.value.weight;
            break;
        case "Furniture":
            requestBody.attribute = `${form.value.height}X${form.value.length}X${form.value.width}`;
            break;
    }

    requestBody.sku = form.value.sku;
    requestBody.name = form.value.name;
    requestBody.price = form.value.price;
    requestBody.type = form.value.type;
    console.log("Request body:", JSON.stringify(requestBody));
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(requestBody),
    });

    console.log("resp", response);
    console.log("resp ok", response.ok);
    if (response.ok) {
        form.value = data();
    }
}
</script>

<style scoped>
.add-product {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    justify-content: space-between;
}

.wrapper {
    position: absolute;
    right: 20%;
    top: 30%;
    border: 3px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    width: 20%;
    display: flex;
    flex-direction: column;
}

.input-container {
    display: flex;
    flex-direction: column;
}

.input-fields, .type-select {
    font-size: 20px;
}

.input-fields {
    padding-bottom: 15px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.type-select {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    width: 100%;
    align-self: flex-end;
}

.select-choice p {
    width: 200%;
}

.select-choice {
    border: solid;
    border-radius: 5px;
    padding: 15px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2px;
    justify-items: start;
    align-items: center;
}

input,
select {
    font-size: 20px;
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.buttons {
    display: flex;
}
</style>
