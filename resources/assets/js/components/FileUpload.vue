<template>
    <div class="row">
        <div v-if="progress < 100">
            <input type="file" v-on:change="onFileChange" class="form-control">
            <progress min="0" max="0" value="{{progress}}"></progress>
        </div>
        <div v-if="progress < 0">
            <p>An error occured</p>
        </div>
        <div v-if="progress >= 100">
            <p>File uploaded completely</p>
        </div>
    </div>
</template>
<style scoped>

</style>
<script>
    export default {
        data(){
            return {
                file: '',
                progress: 0
            }
        },
        props: ['target'],
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createFile(files[0]);
            },
            createFile(file) {
                let reader = new FileReader();
                let vm = this;
                this.file = file;
                this.upload();
            },
            upload(){
                axios.post(this.target,{file: this.file}, {
                    onUploadProgress: (progressEvent) => {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.progress = percentCompleted;
                    }
                }).then(response => {

                });
            }
        }
    }
</script>