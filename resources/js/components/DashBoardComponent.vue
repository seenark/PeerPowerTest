<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">Data Usage Overview</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="font-weigth-bold">Total Size:</span>
                            </div>
                            <div class="col-4">{{sizeInMB(totalSizes)}} MB ({{totalSizes}}Byte)</div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="font-weigth-bold">No of files:</span>
                            </div>
                            <div class="col-4">{{totalOfFiles}}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header font-weight-bold">Disk Usage composition</div>

                    <div v-if="totalOfFiles > 0">
                        <div class="card-body m-1">
                            <div class="row p-2">
                                <div class="col">
                                    <span class="font-weight-bold">Type</span>
                                </div>
                                <div class="col">
                                    <span class="font-weight-bold">No Of Files</span>
                                </div>
                                <div class="col">
                                    <span class="font-weight-bold">Sizes</span>
                                </div>
                            </div>
                            <div class="row border-top p-2" v-if="getJpgFiles.numberOfFiles > 0">
                                <div class="col">
                                    <span class>image/jpg</span>
                                </div>
                                <div class="col">
                                    <span class>{{getJpgFiles.numberOfFiles}}</span>
                                </div>
                                <div class="col">
                                    <span
                                        class
                                    >{{sizeInMB(getJpgFiles.size)}} MB ({{getJpgFiles.size}} bytes)</span>
                                </div>
                            </div>
                            <div class="row border-top p-2" v-if="getPngFiles.numberOfFiles > 0">
                                <div class="col">
                                    <span class>image/png</span>
                                </div>
                                <div class="col">
                                    <span class>{{getPngFiles.numberOfFiles}}</span>
                                </div>
                                <div class="col">
                                    <span
                                        class
                                    >{{sizeInMB(getPngFiles.size)}} MB ({{getPngFiles.size}} bytes)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="card-body m-1">No Data</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.card-header {
    background-color: white;
}
.card-body {
    color: rgb(118, 130, 138);
}
</style>

<script>
export default {
    mounted() {
        this.fetchImages()
    },
    data() {
        return {
            files: [],
        };
    },
    computed: {
        totalOfFiles() {
            return this.files.length;
        },
        totalSizes() {
            let total = 0;
            this.files.forEach((currentFile) => {
                total = total + currentFile.size;
            });
            return total;
        },
        getJpgFiles() {
            let count = 0;
            let size = 0;
            this.files.forEach((file) => {
                const type = file.type.toLowerCase();
                if (type == "jpg") {
                    count++;
                    size += file.size;
                }
            });
            return {
                numberOfFiles: count,
                size: size,
            };
        },
        getPngFiles() {
            let count = 0;
            let size = 0;
            this.files.forEach((file) => {
                const type = file.type.toLowerCase();
                if (type == "png") {
                    count++;
                    size += file.size;
                }
            });
            return {
                numberOfFiles: count,
                size: size,
            };
        },
    },
    methods: {
        sizeInMB(size) {
            return (size/1000000).toFixed(2);
        },
        async fetchImages() {
            const res = await axios.get("/getImages");
            this.files = res.data.data;

        },
    },
};
</script>
