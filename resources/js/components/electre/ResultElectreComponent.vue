<template>
    <!-- <div class="container"> -->
        <div class="row col-12 justify-content-center">
            <div class="col-7 col-md-8 col-xs-12 mt-3 ">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ pageTitle }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4> Bobot Preferensi </h4>
                                <table class="table table-hover table-bordered">
                                    <thead> 
                                        <tr>                                                                               
                                            <th v-for="(b, index) in bobot" :key="index">
                                                {{ b.label }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td v-for="(b, index) in bobot" :key="index">
                                                {{ b.nilai }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>
                            
                            <div class="col-12">
                                <h4><b> Matrix X</b></h4>
                                <table class="table table-hover table-bordered">
                                    <thead> 
                                        <tr> 
                                            <th>#</th>                                                                              
                                            <th v-for="(b, index) in bobot" :key="index">
                                                {{ b.label }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(matrix, index) in matrix_x" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h4><b> Matrix R</b></h4>
                                <table class="table table-hover table-bordered">
                                    <thead> 
                                        <tr> 
                                            <th>#</th>                                                                              
                                            <th v-for="(b, index) in bobot" :key="index">
                                                {{ b.label }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(matrix, index) in matrix_r" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h4><b> Matrix V</b></h4>
                                <table class="table table-hover table-bordered">
                                    <thead> 
                                        <tr> 
                                            <th>#</th>                                                                              
                                            <th v-for="(b, index) in bobot" :key="index">
                                                {{ b.label }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(matrix, index) in matrix_v" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>
                            
                        </div>                    
                    </div>                    
                </div>
            </div>
            
        </div>       

    <!-- </div> -->
</template>

<script>
import VueRangeSlider from 'vue-range-component'
import Multiselect from 'vue-multiselect'
import {mapGetters} from 'vuex';
import {createHelpers} from 'vuex-map-fields'

const {
  mapFields
} = createHelpers({
  getterType: 'electre/getField',
  mutationType: 'electre/UPDATE_FIELD',
});

export default {   
     components:
    {    
        'multiselect': Multiselect,            
        'vue-range' : VueRangeSlider
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
        ...mapGetters({   
            bobot: 'electre/getBobot',
            matrix_x: 'electre/getMatrixX',
            matrix_r: 'electre/getMatrixR',
            matrix_v: 'electre/getMatrixV',
        })
    },    
    befordCreated(){
        
    },
    created(){
        this.init();        
        
    },
    methods:{
        init()
        {    
            console.log(this.bobot)
            console.log(this.matrix_x)
            console.log(this.matrix_r)
            console.log(this.matrix_v)
        },       
        
    },
    data(){
        return{
           a:[]   
        }
    }
}
</script>
