<template>
    <div>
        <b-row>
            <b-col lg="8">
                <div class="card_column">
                    <h1>Investimentos</h1>
                    <b-table :items="items" :fields="fields">
<!--                        <template #table-caption>This is a table caption.</template>-->
                    </b-table>
                </div>
            </b-col>
            <b-col lg="4">
                <div class="card_column">
                    <h1>Novo investimento</h1>
                    <form @submit="formSubmit" enctype="multipart/form-data">
                        <input type="file" class="form-control" v-on:change="onFileChange">
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import { BRow, BCol, BTable } from 'bootstrap-vue'

export default {
    components:{
        BRow, BCol, BTable
    },
    data() {
        return {
            name: '',
            file: '',
            success: '',
            fields: ['ações', 'quantidade'],
            items: [
                { quantidade: 89, ações: 'PETRO' },
                { quantidade: 40, ações: 'ABEV3' },
                { quantidade: 21, ações: 'MRVE3' },
            ]
        }
    },
    methods: {
        onFileChange(e){
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('file', this.file);

            axios.post('/api/upload-pdf', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
        }
    }
}
</script>

<style scoped>

</style>
