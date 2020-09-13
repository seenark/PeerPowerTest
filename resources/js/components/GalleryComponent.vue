<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 bg-white p-3">
                <div class="container">
                    <div class="row">Gallery</div>
                    <div class="row">
                        <div class="col m-2">
                            <uploadZone @uploaded="fetchImages"></uploadZone>
                        </div>
                        <div class="card-columns col-12">
                            <div
                                class="card img-container"
                                v-for="(image,index) in images"
                                :key="index"
                            >
                                <div class="button-hover row mx-auto justify-content-center">
                                    <button class="btn btn-primary" v-if="checkType(image)" @click="zoomClicked(image)">
                                        <svg
                                            width="1em"
                                            height="1em"
                                            viewBox="0 0 16 16"
                                            class="bi bi-search"
                                            fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"
                                            />
                                        </svg>
                                    </button>

                                    <button
                                        class="btn btn-danger"
                                        @click="removeImages(image,index)"
                                    >
                                        <svg
                                            width="1em"
                                            height="1em"
                                            viewBox="0 0 16 16"
                                            class="bi bi-trash"
                                            fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <img
                                    v-if="checkType(image)"
                                    :src="makeImageSource(image)"
                                    class="img-thumbnail"
                                />
                                <div v-else class="incorrect-file">
                                    <svg
                                        width="1.0625em"
                                        height="1em"
                                        viewBox="0 0 17 16"
                                        class="bi bi-exclamation-triangle"
                                        fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"
                                        />
                                        <path
                                            d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"
                                        />
                                    </svg>
                                    <br />
                                    <span>File type not supported.</span>
                                    <br />
                                    <span>{{image.image}}.{{image.type}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="zoom text-center" v-show="zoom">
            <img :src="zoomImage" class="img-thumbnail" />
            <button class="btn btn-danger" @click="zoom=false">X</button>
        </div>
    </div>
</template>

<script>
import uploadZone from "./UploadZone";
import axios from "axios";

export default {
    name: "Gallery",
    components: {
        uploadZone,
    },
    data() {
        return {
            images: [],
            zoom: false,
            zoomImage: "",
        };
    },
    methods: {
        async fetchImages() {
            const res = await axios.get("/getImages");
            console.log(res);
            this.images = res.data.data;
        },
        makeImageSource(image) {
            const name = image.image;
            const type = image.type;
            return `/storage/image/${name}.${type}`;
        },
        async removeImages(image, index) {
            this.images.splice(index, 1);
            const res = await axios.delete(`/gallery/${image.id}`);
            console.log(res);
        },
        zoomClicked(image) {
            this.zoomImage = this.makeImageSource(image);
            this.zoom = true;
        },
        checkType(image) {
            if (image.type == "jpg" || image.type == "png") {
                return true;
            } else {
                return false;
            }
        },
    },
    computed: {},
    mounted() {
        this.fetchImages();
    },
};
</script>

<style scoped>
img {
    width: 100%;
    height: 200px;
    object-fit: cover !important;
}
.img-container {
    position: relative;
    overflow: hidden;
}
.img-container:hover {
    cursor: pointer;
}
.button-hover {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    display: flexbox;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    opacity: 0;
}
.button-hover:hover {
    opacity: 1;
    background-color: rgba(32, 32, 32, 0.514);
}
button {
    height: 50px;
    width: 50px;
    margin: 0.5rem;
}
.container {
    position: relative;
}
.zoom {
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.514);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.zoom > img {
    position: relative;
    padding: 16px;
    height: auto;
    max-height: 80vh;
    width: 640px;
    object-fit: contain;
}

.incorrect-file {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    color: rgb(220, 54, 69);
}

.incorrect-file > svg {
    font-size: 5rem;
}
</style>
