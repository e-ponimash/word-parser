<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Word parser</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-text">Input text</label>
                            <textarea class="form-control" id="input-text" rows="3" v-model="input_text"></textarea>
                        </div>
                        <button class="btn btn-primary" @click="process" :disable="loading">
                            <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Process
                        </button>
                    </div>

                    <div class="card-footer" v-if="error_text || status_text">
                        <div class="alert alert-danger" v-if="error_text">{{ error_text }}</div>
                        <div class="alert alert-info" v-if="status_text">{{ status_text }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data (vm) {
            return {
                input_text: null,
                error_text: null,
                status_text: null,
                loading: false,
            }
        },
        methods: {
            process: function(){
                this.status_text = null
                this.error_text = null
                this.loading = true

                axios.post('/store', {body: this.input_text})
                    .then(response => {
                        this.status_text = 'Сохранено '+response.data.words.length+' слов'
                    })
                    .catch(error => {
                        this.error_text = error.response.data.message
                    })
                    .finally(() => {
                        this.loading = false
                        setTimeout(() => {
                            this.error_text = null
                            this.status_text = null
                        }, 7000)
                    })
            }
        }
    }
</script>
