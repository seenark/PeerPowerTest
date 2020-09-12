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

                                        <button class="btn btn-primary" @click="zoomClicked(image)">
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


                                        <button class="btn btn-danger" @click="removeImages(image,index)">
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
                                <img :src="makeImageSource(image)" class="img-thumbnail" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="zoom text-center" v-show="zoom">
            <img :src="zoomImage" class="img-thumbnail">
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
            zoom:false,
            zoomImage:""
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
        async removeImages(image,index) {
            this.images.splice(index,1)
            const res = await axios.delete(`/gallery/${image.id}`)
            console.log(res)
        },
        zoomClicked(image) {
            this.zoomImage = this.makeImageSource(image)
            this.zoom = true
        }
    },
    computed: {

    },
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
    position: fixed;;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.514);
    display: flex;
    flex-direction: column;
    align-items: center;

}
.zoom>img {
    position: relative;
    padding: 16px;
    height: auto;
    max-height: 80vh;
    width: 640px;
    object-fit:contain;
}

</style>
