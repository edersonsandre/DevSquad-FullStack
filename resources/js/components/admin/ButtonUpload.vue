<template>
    <div>
        <h2>Upload de Arquivo CSV</h2>
        <hr/>

        <div class="well well-sm">
            <div class="alert alert-info">Envie somente arquivo em CSV conforme layout proposto.<br/>Os arquivos serão processo em background e um relatorio
                será enviado por email.
            </div>
            <div class="error-description"></div>
            <input type="file"
                   id="file"
                   ref="file"
                   @change="handleFilesUpload"
            >
        </div>
    </div>
</template>

<script>
    export default {
        name: "ButtonUpload",
        data() {
            return {
                file: ''
            }
        },
        methods: {
            onFileSelected(event) {

            },
            handleFilesUpload() {
                $(".error-description").html("");

                this.file = this.$refs.file.files[0];

                let formData = new FormData();
                formData.append('file', this.file);

                const axios = require('axios');

                axios.post('/admin/produtos/upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function (response) {
                    if (response.status) {
                        Swal.closeModal();

                        Swal.fire('Arquivo importado com sucesso, apos o processamento você receberá um email!');
                    }
                }).catch(function (error) {
                    if (error.response.data.errors.file != undefined) {
                        $(".error-description").html("<div class='alert alert-danger'>" + error.response.data.errors.file + "</div>");
                    } else {

                    }

                });
            }
        }
    }
</script>

<style scoped>

</style>
