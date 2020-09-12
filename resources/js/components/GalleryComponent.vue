<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 bg-white p-3">
                <div class="container">
                    <div class="row">
                        Gallery
                    </div>
                    <div class="row">
                        <div class="col m-2">
                            <uploadZone></uploadZone>
                        </div>
                        <div class="card-columns col-12">
                            <div class="card">123</div>
                            <div class="card">456</div>
                            <div class="card">789</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import uploadZone from './UploadZone'

export default {
    name:"Gallery",
    components:{
        uploadZone
    }
}
</script>

