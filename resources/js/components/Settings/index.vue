<template>
    <div>

        <div class="text-center">
            <img :src="'admin/img/think.svg'" style="max-height: 90px">
            <h4 class="pt-3">save your <b>imagination</b> here!</h4>
        </div>

        <!---
        <ol class="breadcrumb">
            <li>
                <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
            </li>
            <li class="active">Business</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <panel>
                    <template slot="title">Business Settings</template>
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#business" aria-controls="business"
                                    role="tab" data-toggle="tab">Business</a></li>
                            <li role="presentation"><a href="#tax" aria-controls="tax" role="tab"
                                    data-toggle="tab">Tax</a></li>
                            <li role="presentation"><a href="#email_settings" aria-controls="email_settings" role="tab"
                                    data-toggle="tab">Email Settings</a></li>
                        </ul>
                        <form class="form-vertical" @submit.prevent="update()" @keydown="form.onKeydown($event)">
                            <AlertErrors :form="form" class="mt-2"
                                message="There were some problems with your input." />
                            <div class="tab-content" style="padding: 2em 1em;">
                                <div role="tabpanel" class="tab-pane  active" id="business">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-4 col-form-label">
                                                    Business Name <i class="text-danger">*</i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.name" class="form-control" id="name"
                                                        type="text" placeholder="Business Name" tabindex="1" required>
                                                    <HasError :form="form" field="name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="currency_id" class="col-sm-4 col-form-label">
                                                    Currency <i class="text-danger">*</i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <Select2 v-model="form.currency_id" :options="currencies"
                                                        id="currency_id" placeholder="Select Currency" tabindex="2"
                                                        required />
                                                    <HasError :form="form" field="currency_id" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="currency_symbol_placement" class="col-sm-4 col-form-label">
                                                    Currency Symbol Placement
                                                </label>
                                                <div class="col-sm-8">
                                                    <select v-model="form.currency_symbol_placement"
                                                        class="form-control" id="currency_symbol_placement"
                                                        tabindex="3">
                                                        <option value="before">Before Amount</option>
                                                        <option value="after">After Amount</option>
                                                    </select>
                                                    <HasError :form="form" field="currency_symbol_placement" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="logo" class="col-sm-4 col-form-label">
                                                    Logo
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" @change="uploadFile" class="form-control"
                                                        id="logo" tabindex="4" />
                                                    <HasError :form="form" field="logo" />
                                                    <div id="image_preview" class="mt-2">
                                                        <img class="elevation-2" :src="getImage()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="tax">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="tax_number" class="col-sm-4 col-form-label">
                                                    Tax Number
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.tax_number" class="form-control"
                                                        id="tax_number" type="text" placeholder="Tax Number"
                                                        tabindex="5">
                                                    <HasError :form="form" field="tax_number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="email_settings">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="mail_driver" class="col-sm-4 col-form-label">
                                                    Mail Driver
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.driver" class="form-control"
                                                        id="mail_driver" type="text" placeholder="SMTP" tabindex="6">
                                                    <HasError :form="form" field="email_settings.driver" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="host" class="col-sm-4 col-form-label">
                                                    Host
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.host" class="form-control"
                                                        id="host" type="text" placeholder="localhost" tabindex="7">
                                                    <HasError :form="form" field="email_settings.host" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="port" class="col-sm-4 col-form-label">
                                                    Port
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.port" class="form-control"
                                                        id="port" type="number" placeholder="456" tabindex="8">
                                                    <HasError :form="form" field="email_settings.port" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-4 col-form-label">
                                                    Username
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.username" class="form-control"
                                                        id="username" type="email" placeholder="Username" tabindex="9">
                                                    <HasError :form="form" field="email_settings.username" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-4 col-form-label">
                                                    Password
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.password" class="form-control"
                                                        id="password" type="text" placeholder="Password" tabindex="10">
                                                    <HasError :form="form" field="email_settings.password" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="encryption" class="col-sm-4 col-form-label">
                                                    Encryption
                                                </label>
                                                <div class="col-sm-8">
                                                    <select v-model="form.email_settings.encryption"
                                                        class="form-control" id="encryption" tabindex="11">
                                                        <option value="SSL">SSL</option>
                                                        <option value="TLS">TLS</option>
                                                        <option value="STARTTLS">STARTTLS</option>
                                                    </select>
                                                    <HasError :form="form" field="email_settings.encryption" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="from" class="col-sm-4 col-form-label">
                                                    From Email
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.from" class="form-control"
                                                        id="from" type="email" placeholder="From Email" tabindex="12">
                                                    <HasError :form="form" field="email_settings.from" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="from_name" class="col-sm-4 col-form-label">
                                                    From Name
                                                </label>
                                                <div class="col-sm-8">
                                                    <input v-model="form.email_settings.name" class="form-control"
                                                        id="from_name" type="text" placeholder="From Name"
                                                        tabindex="13">
                                                    <HasError :form="form" field="email_settings.name" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" :disabled="form.busy">
                                    Update Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </panel>
            </div>
        </div>
        -->
    </div>
</template>

<script>
import Select2 from 'v-select2-component';

export default {

    data: () => ({
        baseEndPoint: '/api/business',
        currencies: [],
        form: new Form({
            id: '',
            name: '',
            currency_id: '',
            currency_symbol_placement: '',
            logo: null,
            tax_number: '',
            email_settings: {
                driver: 'SMTP',
                host: 'localhost',
                port: '456',
                username: '',
                password: '',
                encryption: 'SSL',
                from: '',
                name: '',
            }
        }),
    }),
    components: {
        Select2
    },

    methods: {
        getCurrencies() {
            this.$Progress.start();
            axios.get('/api/currencies'
            ).then(({ data }) => {
                this.currencies = data.data;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        getSettings() {
            this.$Progress.start();
            this.form.get(this.baseEndPoint
            ).then(({ data }) => {
                this.form.fill(data.data[0]);
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
                console.log('Error: ' + error);
            });
        },
        getImage() {
            if (!this.form.logo) return;
            return (this.form.logo.length > 200)
                ? this.form.logo
                : this.form.logo;
        },
        uploadFile(e) {
            let file = e.target.files[0];
            if (file['size'] <= '2097152') {

                let reader = new FileReader()

                reader.onloadend = (file) => {
                    this.form.logo = reader.result;
                }

                reader.readAsDataURL(file);
            } else {

                Notification.error('You are uploading a large file.');
            }
        },
        update() {
            this.$Progress.start();
            this.form.put(this.baseEndPoint + '/' + this.form.id).then(() => {

                Notification.success('Settings Updated');

                this.$Progress.finish();
            }).catch((error) => this.$Progress.fail());
        },
    },
    created() {
        this.getSettings();
        this.getCurrencies();
    }
}
</script>
