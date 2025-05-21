<template>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Products</h1>
        </div>
        <!--Refresh Products Button: from API to DB-->
        <div class="col-md-6 text-md-end">
            <button @click="fetchProductsFromApi" class="btn btn-primary mb-3">
                <i class="bi bi-cloud-download"></i>
                Refresh from API to DB
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            apiMessage: '',
            apiSuccess: false,
        }
    },
    methods: {
        // Fetch products from API and store them in the database
        fetchProductsFromApi() {
            this.apiMessage = '';

            axios.get('/api/products/fetch')
                .then(response => {
                    this.apiMessage = response.data.message;
                    this.apiSuccess = response.data.success;
                })
                .catch(error => {
                    this.apiMessage = 'An error occurred while fetching products: ' + error.message;
                    this.apiSuccess = false;
                });
        },
    }
}
</script>
