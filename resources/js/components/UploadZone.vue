<template>
    <form enctype="multipart/form-data" class="border-dashed text-center" @submit.prevent="sendFile">

            <label class="col-12 p-0 text-center">
                <span aria-hidden="true">
                    <svg
                        width="5em"
                        height="5em"
                        viewBox="0 0 16 16"
                        class="bi bi-cloud-arrow-up"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"
                        />
                        <path
                            fill-rule="evenodd"
                            d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"
                        />
                    </svg>
                </span>
                <br>
                <span>Drop files here or click to upload...</span>
                <input type="file" multiple @change="selectFile"/>
            </label>
            <br>
            <button class="btn btn-primary">Submit</button>
    </form>
</template>

<script>
import axios from "axios";
export default {
    name: "uploadZone",
    data() {
        return {
            files: "",
        };
    },
    methods: {
        selectFile(event) {
            this.files = event.srcElement.files;
            console.log(this.files)
        },
        async sendFile() {
            const formData = new FormData();
            formData.append("files", this.files);

            try {
                await axios.post("/upload", formData);
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style scoped>
.border-dashed {
    /* height: 10rem; */
    outline: 2px dashed rgb(215, 219, 218);
}
label {
    font-size: 1.3rem;
    cursor: pointer;
    height: 200px;
    position: relative;
}
label>input {
    position: absolute;
    width: 100%;
    height: 200px;
    opacity: 0;
    cursor: pointer;
    background-color: gray;
    top: 0;
    left: 0;
}


</style>
