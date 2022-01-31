<template>
    <div>
        <b-row>
            <b-row style="padding: 20px">
                <b-col lg="3" v-if="!new_invest">
                    <b-form-input
                        type="text"
                        placeholder="Buscar investimento"
                    ></b-form-input>
                </b-col>
                <b-col>
                    <b-button variant="primary" @click="new_invest = !new_invest" v-if="!new_invest">
                        Cadastrar novo
                    </b-button>
                    <p @click="new_invest = !new_invest"  v-if="new_invest"> <- Voltar</p>
                </b-col>
            </b-row>

            <b-col lg="12" v-if="!new_invest">
                <div class="card_column">
                    <b-table :items="items" :fields="fields">
<!--                        <template #table-caption>This is a table caption.</template>-->
                    </b-table>
                </div>
            </b-col>

            <b-col lg="12" v-if="new_invest">
                <div class="card_column">
                    <b-row>
                        <b-col lg="12" v-if="!form">
                            <div class="upload">
                                <form @submit="formSubmit" enctype="multipart/form-data">
                                    <p>{{ form }}</p>
                                    <h4 class="text-center">Faça o upload da nota de corretagem</h4>
                                    <input type="file" class="form-control mt-3" v-on:change="onFileChange">
                                    <button class="btn btn-success mt-3">Cadastrar</button>
                                </form>
                            </div>
                        </b-col>
                        <b-col lg="12" v-if="form">
                            <b-col lg="8">
                                <b-row
                                    v-for="(item, index) in form"
                                    :key="index"
                                >

                                    <b-col lg="1">
                                        <b-form-group
                                            label="cv"
                                        >
                                            <b-form-input
                                                v-model="item.cv"
                                                placeholder="cv"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Mercadoria"
                                        >
                                            <b-form-input
                                                v-model="item.mercadoria"
                                                placeholder="Mercadoria"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Preço"
                                        >
                                            <b-form-input
                                                v-model="item.preco"
                                                placeholder="Preço"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="1">
                                        <b-form-group
                                            label="Quantidade"
                                        >
                                            <b-form-input
                                                v-model="item.quantidade"
                                                placeholder="Quantidade"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Taxa"
                                        >
                                            <b-form-input
                                                v-model="item.taxa"
                                                placeholder="Taxa"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Tipo"
                                        >
                                            <b-form-input
                                                v-model="item.tipo"
                                                placeholder="Tipo"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Valor"
                                        >
                                            <b-form-input
                                                v-model="item.valor"
                                                placeholder="Valor"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col  lg="2">
                                        <b-form-group
                                            label="Vencimento"
                                        >
                                            <b-form-input
                                                v-model="item.vencimento"
                                                placeholder="Vencimento"
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                </b-row>
                            </b-col>
                        </b-col>
                    </b-row>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import { BRow, BCol, BTable, BButton, BFormInput, BFormGroup } from 'bootstrap-vue'

export default {
    components:{
        BRow, BCol, BTable, BButton, BFormInput, BFormGroup
    },
    data() {
        return {
            new_invest: false,
            name: '',
            file: '',
            success: '',
            fields: ['ações', 'quantidade'],
            form: null,
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
                    currentObj.form = response.data
                    console.log('response', response)
                })
                .catch(function (error) {
                });
        }
    }
}
</script>

<style scoped>
    .upload{
        padding: 33px 20px;
        text-align:center;
    }
</style>
