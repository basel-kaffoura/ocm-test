<template>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Products</h1>
        </div>
        <!--Refresh Products Button: from API to DB-->
        <div class="col-md-6 text-md-end">
            <button @click="fetchProductsFromApi" class="btn btn-primary mb-3">
                <i class="bi bi-cloud-download"></i>
                Refresh from API to DB to Page
            </button>
        </div>

        <!--API success message-->
        <div class="alert alert-success" v-if="apiMessage && apiSuccess">
            {{ apiMessage }}
        </div>
        <!--API error message-->
        <div class="alert alert-danger" v-if="apiMessage && !apiSuccess">
            {{ apiMessage }}
        </div>

        <!--No products available section-->
        <div v-else-if="products.length === 0" class="text-center">
            <i class="bi bi-inbox display-1 text-muted"></i>
            <h3 class="mt-3">No products available</h3>
            <p>Try updating products from the API</p>
        </div>
        <!--Products available section-->
        <div v-else class="row">
            <div v-for="product in products" :key="product.id" class="col">
                <div class="card">
                    <div class="text-center">
                        <img
                            :src="product.image"
                            class="product-image"
                            :alt="product.title"
                        />
                    </div>
                    <div class="card-body">
                        <h5>{{ product.title }}</h5>
                        <p>{{ product.description }}</p>
                        <div class="bg-info">
                            <span>{{ product.category }} | {{ product.price }}$</span>
                        </div>
                    </div>
                    <div class="card-footer">
                            <small>Rating: {{ product.rating_rate }}/5, {{ product.rating_count }} ratings</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            apiMessage: '',
            apiSuccess: false,
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        // Fetch products from API and store them in the database
        fetchProductsFromApi() {
            this.apiMessage = '';

            axios.get('/api/products/fetch')
                .then(response => {
                    this.apiMessage = response.data.message;
                    this.apiSuccess = response.data.success;
                    if (this.apiSuccess) {
                        this.getProducts();
                    }
                })
                .catch(error => {
                    this.apiMessage = 'An error occurred while fetching products: ' + error.message;
                    this.apiSuccess = false;
                });
        },

        // Fetch products from DB
        getProducts() {
            axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.error("An error occurred while fetching products: ", error);
                });
        },
    }
}
</script>
