<template>
    <!-- <div class="container"> -->
        <div class="row col-12 justify-content-center">
            <div class="col-12 col-md-12 col-xs-12 mt-3 ">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ pageTitle }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5> Bobot Preferensi </h5>
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
                                <h5><b> Matrix X</b></h5>
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
                                            <td>{{ matrix.data.nama }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h5>Normalisasi Matriks X</h5>
                                <p><b> Matrix R</b></p>
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
                                            <td>{{ matrix.data.nama }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h5>Pembobotan pada Matriks R</h5>
                                <p><b> Matrix V</b></p>
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
                                            <td>{{ matrix.data.nama }}</td>
                                            <td v-for="(n, idx) in matrix.nilai" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>
                            <div class="col-12">
                                <h5>Menentukan Matriks Concordance dan Disconcordance</h5>
                                <p><b> Matrix Concordance</b></p>
                                <table class="table table-hover table-bordered">                                   
                                    <tbody>
                                        <tr v-for="(matrix, index) in cd_dd" :key="index">
                                            <!-- <td>{{ index+1 }}</td> -->
                                            <td v-for="(n, idx) in matrix" :key="idx">
                                                {{ n.nilaiCD }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <p><b> Matrix Disconcordance</b></p>
                                <table class="table table-hover table-bordered">                                   
                                    <tbody>
                                        <tr v-for="(matrix, index) in cd_dd" :key="index">
                                            <!-- <td>{{ index+1 }}</td> -->
                                            <td v-for="(n, idx) in matrix" :key="idx">
                                                {{ n.nilaiDD }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h5>Menentukan Matriks Dominan Concordance dan Dominan Disconcordance</h5>
                                <p><b> Matrix Dominan Concordance</b></p>
                                <p>Threshold Concordance: {{ threshold_cd }}</p>
                                <table class="table table-hover table-bordered">                                   
                                    <tbody>
                                        <tr v-for="(matrix, index) in dominan_cd_dd" :key="index">
                                            <!-- <td>{{ index+1 }}</td> -->
                                            <td v-for="(n, idx) in matrix" :key="idx">
                                                {{ n.d_dd }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <p><b> Matrix Dominan Disconcordance</b></p>
                                <p>Threshold Disconcordance: {{ threshold_dd }}</p>
                                <table class="table table-hover table-bordered">                                   
                                    <tbody>
                                        <tr v-for="(matrix, index) in dominan_cd_dd" :key="index">
                                            <!-- <td>{{ index+1 }}</td> -->
                                            <td v-for="(n, idx) in matrix" :key="idx">
                                                {{ n.d_cd }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <hr >
                            </div>

                            <div class="col-12">
                                <h5>Menentukan Matriks Aggregate Dominan</h5>
                                <p><b> Matrix Aggregate Dominan</b></p>                                
                                <table class="table table-hover table-bordered">                                   
                                    <tbody>
                                        <tr v-for="(matrix, index) in aggregate_dominan" :key="index">
                                            <!-- <td>{{ index+1 }}</td> -->
                                            <td v-for="(n, idx) in matrix" :key="idx">
                                                {{ n }}
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>                                
                                <hr >
                            </div>

                             <div class="col-12">
                                <h5>Eliminasi Alternatif dan Ranking</h5>                                
                                <table class="table table-hover table-bordered">      
                                    <thead> 
                                        <tr>                                                                               
                                            <th>#</th>
                                            <th>Nama Hero</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>                             
                                    <tbody>
                                        <tr v-for="(matrix, index) in rank" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ matrix.hero_name }}</td>                                                                   
                                            <td>{{ matrix.total }}</td>                                                                   
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
            cd_dd: 'electre/getCD_DD',            
            dominan_cd_dd: 'electre/getDominan_CDDD',
            threshold_cd: 'electre/getThresholdCD',
            threshold_dd: 'electre/getThresholdDD',
            aggregate_dominan: 'electre/getAggregateDominan',
            rank: 'electre/getRanking',
        })
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
            console.log(this.cd_dd)
            console.log(this.dominan_cd_dd)
            console.log(this.threshold_cd)
            console.log(this.threshold_dd)
            console.log(this.aggregate_dominan)
            console.log(this.rank)
        },       
        
    },
    data(){
        return{
           a:[]   
        }
    }
}
</script>
