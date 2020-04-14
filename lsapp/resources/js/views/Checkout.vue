<template>

        <div class="container">

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="order-box">
                        <img :src="product.image" :alt="product.name">
                        <h2 class="title" v-html="product.name"></h2>
                        <p class="small-text text-muted float-left">$ {{product.price}}</p>
                        <p class="small-text text-muted float-right">Available Units: {{product.units}}</p>
                        <br>
                        <hr>
                        <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits"></label>
                    </div>
                    <br>
                    <div>
                        <!--<div v-if="!isLoggedIn">
                            <h2>You need to login to continue</h2>
                            <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                            <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                        </div>-->
                        <!--<div v-if="isLoggedIn">
                            <div class="row">
                                <label for="address" class="col-md-3 col-form-label">Delivery Address</label>
                                <div class="col-md-9">
                                    <input id="address" type="text" class="form-control" v-model="address" required>
                                </div>
                            </div>
                            <br>
                            <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="placeOrder">Continue</button>
                        </div>-->
                    </div>
                </div>
            </div>
            <!--form-->
            <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
                  action="/paypal">
                <div class="w3-container w3-teal w3-padding-16">Paywith Paypal</div>
<!--
                {{ token }}
-->
                <h2 class="w3-text-blue">Payment Form</h2>
                <p>Demo PayPal form - Integrating paypal in laravel</p>
                <label class="w3-text-blue"><b>Enter Amount</b></label>
                <input class="w3-input w3-border" id="amount" type="text" name="amount"></p>
                <button class="w3-btn w3-blue">Pay with PayPal</button>
            </form>
            <!--form-->
            <!--<div class="card-body">
                <form @submit="formSubmit">
                    <strong>Name:</strong>
                    <input type="text" class="form-control" v-model="name">
                    <button class="btn btn-success">Submit</button>
                </form>
                <strong>Output:</strong>
                <pre>
                        {{output}}
                        </pre>
            </div>-->

            <!--form-->
        </div>

    </template>

    <style scoped>
    .small-text { font-size: 18px; }
    .order-box { border: 1px solid #cccccc; padding: 10px 15px; }
    .title { font-size: 36px; }
    </style>



     <script>
/*
         var csrf_token = $('meta[name="csrf-token"]').attr('content');
*/

         export default {

            props : ['pid'],
            data(){
                return {
                    address : "",
                    quantity : 1,
                    isLoggedIn : null,
                    product : [],
                    name :'',
                    output: '',
                    token   : csrf_token,

                }
            },
            mounted() {
                this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null


            },
            beforeMount() {
                axios.get(`/api/products/${this.pid}`).then(response => this.product = response.data)

                if (localStorage.getItem('bigStore.jwt') != null) {
                    this.user = JSON.parse(localStorage.getItem('bigStore.user'))
                    axios.defaults.headers.common['Content-Type'] = 'application/json'
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
                }
            },
            methods : {
                login() {
                    this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
                },
                register() {
                    this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
                },
                placeOrder(e) {
                    e.preventDefault()

                    let address = this.address
                    let product_id = this.product.id
                    let quantity = this.quantity

                    axios.post('api/orders/', {address, quantity, product_id})
                         .then(response => this.$router.push('/confirmation'))
                },
                checkUnits(e){
                    if (this.quantity > this.product.units) {
                        this.quantity = this.product.units
                    }
                }/*,
                formSubmit(e) {
                    e.preventDefault();
                    let currentObj = this;
                    axios.post('payapl', {
                        name: this.name,
                    })
                            .then(function (response) {
                                currentObj.output = response.data;
                            })
                            .catch(function (error) {
                                currentObj.output = error;
                            });
                }*/
            }
        }
        </script>