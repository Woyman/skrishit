<template>
    <div class="row mt-3">
        <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Tambah Role Baru</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="namaRole">Nama Role</label>
                        <input type="text" class="form-control" id="namaRole" v-model="role">                    
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Kirim</button>
                </div>
            </div>
        </div>         
    </div>
</template>

<script>

export default {
    components: {
        
    },
    computed:{
       
    }
}
</script>