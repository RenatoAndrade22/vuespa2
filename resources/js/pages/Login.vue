<template>
    <div class="page-login">
        <div class="block">
            <div class="logo-login">
                <img src="/images/logo.png" alt="">
            </div>
            <div class="form">
                <h3>LB3</h3>
                <p>Seja bem vindo, entre com sua conta.</p>
                <b-form @submit="onSubmit" v-if="show">
                    <b-form-group
                        label-for="input-1"
                        class="input input1"
                    >
                        <b-form-input
                            v-model="form.email"
                            placeholder="Email"
                            required
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-2">
                        <b-form-input
                            type="password"
                            v-model="form.password"
                            placeholder="Senha"
                            required
                            class="input input2"
                        ></b-form-input>
                    </b-form-group>
                    <b-form-checkbox
                        id="checkbox-1"
                        name="checkbox-1"
                        value="accepted"
                        unchecked-value="not_accepted"
                    >
                        <p style="margin-left: 7px; top: -5px">Lembrar de mim</p>
                    </b-form-checkbox>
                    <b-button type="submit" class="button" variant="primary">Acessar</b-button>
                </b-form>
            </div>

        </div>
    </div>
</template>

<script>
import {BRow, BCol, BForm, BFormGroup, BFormInput, BFormSelect, BFormCheckboxGroup, BFormCheckbox, BButton, BCard,} from 'bootstrap-vue'

export default {
    components:{
        BRow, BCol, BForm, BFormGroup, BFormInput, BFormSelect, BFormCheckboxGroup, BFormCheckbox, BButton, BCard,
    },
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
            show: true
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            axios.post('/api/login', this.form).then((item) =>{
                this.$router.push({name: "dashboard"})
            })
        },
    }
}
</script>
<style scoped>

    .page-login{
        background: #69ABDE;
        position:absolute;
        top:0;
        bottom:0;
        left: 0;
        right: 0;
    }
    .block{
        width: 680px;
        margin: 0 auto;
        height: 350px;
        margin-top: 10%;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0px 4px 25px 0px rgb(0 0 0 / 10%);
    }
    .logo-login{
        width: 50%;
        float: left;
        text-align: center;
    }
    .logo-login img{
        margin-top: 93px;
    }
    .form{
        width: 50%;
        float: left;
        background: #F8F8F8;
        height: 100%;
        padding: 30px;
    }
    .input{
        margin-bottom: 15px;
    }
    label{
        font-size: 12px;
    }
    p{
        font-size: 13px;
    }
    .button{
        background: #69ABDE;
        border: 0;
    }
</style>
