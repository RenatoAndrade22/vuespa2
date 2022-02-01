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
                            <b-col lg="12">
                                <b-table :items="form" :fields="fields_upload">
                                    <template v-slot:cell(editar)="row">
                                        <b-button variant="primary" @click="editar(row.item.index)">Editar</b-button>
                                    </template>
                                </b-table>
                            </b-col>
                        </b-col>
                    </b-row>
                </div>
            </b-col>
        </b-row>
        <b-modal id="modal-edit" size="lg" title="Editar">
            <b-row v-if="form_edit">
                <b-col lg="1" class="mb-2">
                    <b-form-group
                        label="cv"
                    >
                        <b-form-input
                            v-model="form_edit[0].cv"
                            placeholder="cv"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Mercadoria"
                    >
                        <b-form-input
                            v-model="form_edit[0].mercadoria"
                            placeholder="Mercadoria"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Preço"
                    >
                        <b-form-input
                            v-model="form_edit[0].preco"
                            placeholder="Preço"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col  lg="2" class="mb-2">
                    <b-form-group
                        label="Quantidade"
                    >
                        <b-form-input
                            type="number"
                            v-model="form_edit[0].quantidade"
                            placeholder="Quantidade"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Taxa"
                    >
                        <b-form-input
                            v-model="form_edit[0].taxa"
                            placeholder="Taxa"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Tipo"
                    >
                        <b-form-input
                            v-model="form_edit[0].tipo"
                            placeholder="Tipo"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Valor"
                    >
                        <b-form-input
                            v-model="form_edit[0].valor"
                            placeholder="Valor"
                            v-bind="money"
                        ></b-form-input>
                    </b-form-group>
                </b-col>

                <b-col lg="2" class="mb-2">
                    <b-form-group
                        label="Vencimento"
                    >
                        <b-form-input
                            v-model="form_edit[0].vencimento"
                            placeholder="Vencimento"
                            v-mask="'##/##/####'"

                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <template #modal-footer>
                <div>
                    <b-button
                        variant="primary"
                        size="sm"
                        class="float-right"
                        @click="editSave"
                    >
                        Salvar
                    </b-button>
                </div>
            </template>
        </b-modal>
    </div>
</template>

<script>
import { BRow, BCol, BTable, BButton, BFormInput, BFormGroup } from 'bootstrap-vue'
import { UilEdit } from '@iconscout/vue-unicons'
import {TheMask} from 'vue-the-mask'

import {mask} from 'vue-the-mask'
import {Money} from 'v-money'

export default {
    components:{
        BRow, BCol, BTable, BButton, BFormInput, BFormGroup, UilEdit, TheMask, Money
    },
    directives: {mask},

    data() {
        return {
            money: {
                decimal: ',',
                thousands: '.',
                prefix: '',
                suffix: ' #',
                precision: 2,
                masked: false
            },
            new_invest: false,
            name: '',
            file: '',
            success: '',
            fields: ['ações', 'quantidade'],
            fields_upload: ['cv', 'mercadoria', 'preco', 'quantidade', 'tipo', 'taxa', 'valor', 'vencimento', 'editar'],
            form: [
                {
                    index: 1,
                    cv: 'C',
                    mercadoria: 'WING22',
                    preco: '109.430,0000',
                    quantidade: '1',
                    taxa: '0,00',
                    tipo: 'DAY TRADE',
                    valor: '59,80',
                    vencimento: '16/02/2022',
                    edit: false,
                },
                {
                    index: 2,
                    cv: 'V',
                    mercadoria: 'WING22',
                    preco: '109.910,0000',
                    quantidade: '1',
                    taxa: '0,00',
                    tipo: 'DAY TRADE',
                    valor: '163,80',
                    vencimento: '16/02/2022',
                    edit: false,
                },
            ],

            form_edit: null,

            items: [
                { quantidade: 89, ações: 'PETRO' },
                { quantidade: 40, ações: 'ABEV3' },
                { quantidade: 21, ações: 'MRVE3' },
            ]
        }
    },
    methods: {

        editSave(){
            this.form = collect(this.form).map((item)=>{
                if (item.index === this.form_edit[0].index){
                    item.cv = this.form_edit[0].cv
                    item.mercadoria = this.form_edit[0].mercadoria
                    item.preco = this.form_edit[0].preco
                    item.quantidade = this.form_edit[0].quantidade
                    item.taxa = this.form_edit[0].taxa
                    item.tipo = this.form_edit[0].tipo
                    item.valor = this.form_edit[0].valor
                    item.vencimento = this.form_edit[0].vencimento
                }
                return item
            })
            this.form = this.form.items
            this.$bvModal.hide('modal-edit')

        },

        editar(index){
            this.form_edit = collect(this.form).where('index', index)
            this.form_edit = this.form_edit.items
            this.$bvModal.show('modal-edit')
        },

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
