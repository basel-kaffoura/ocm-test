<template>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Products</h1>
        </div>
        <!--Refresh Products Button: from API to DB-->
        <div class="col-md-6 text-md-end">
            <button @click="fetchProductsFromApi" class="btn btn-primary mb-3" :disabled="loading">
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

        <!--Search products section-->
        <div class="card mb-4">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search products..."
                    />
                </div>
            </div>
        </div>

        <!--Show spinner while loading products-->
        <div v-if="loading" class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2">Loading products...</p>
        </div>

        <!--No products available section-->
        <div v-else-if="products.length === 0" class="text-center">
            <i class="bi bi-inbox display-1 text-muted"></i>
            <h3 class="mt-3">No products available</h3>
            <p>Try updating products from the API</p>
        </div>
        <!--Products available section-->
        <div v-else class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div v-for="product in products" :key="product.id" class="col">
                <div class="card h-100 product-card">
                    <div class="text-center p-3">
                        <img
                            :src="product.image"
                            class="product-image"
                            :alt="product.title"
                        />
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="badge bg-primary">{{ product.category }}</span>
                            <span class="fs-5 fw-bold">{{ product.price }}$</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Rating: {{ product.rating_rate }}/5</small>
                            <small class="text-muted">{{ product.rating_count }} ratings</small>
                        </div>
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
            loading: true,
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        // Fetch products from API and store them in the database
        fetchProductsFromApi() {
            this.loading = true;
            this.apiMessage = '';

            axios.get('/api/products/fetch')
                .then(response => {
                    this.apiMessage = response.data.message;
                    this.apiSuccess = response.data.success;
                    if (this.apiSuccess) {
                        this.getProducts();
                    } else {
                        this.loading = false;
                    }
                })
                .catch(error => {
                    this.apiMessage = 'An error occurred while fetching products: ' + error.message;
                    this.apiSuccess = false;
                    this.loading = false;
                });
        },

        // Fetch products from DB
        getProducts() {
            this.loading = true;
            axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data;
                    this.loading = false;

                })
                .catch((error) => {
                    console.error("An error occurred while fetching products: ", error);
                    this.loading = false;
                });
        },
    }
}
</script>
