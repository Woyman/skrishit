<template>
    <!-- <div class="container"> -->
        <div class="row col-12">
            <div class="col-5 col-xs-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ pageTitle }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" v-for="(kriteria, index) in kriterias" :key="index">
                                    <label for="roleName">{{ kriteria.kriteria_name }}</label>
                                    <vue-range ref="slider" v-model="w[kriteria.kriteria_field]" tooltip="always"></vue-range>    
                                </div>                                                         
                                <div class="form-group">
                                    <label for="role_hero">Role Hero</label>                                    
                                    <multiselect v-model="w['role']" :options="roleOption" :taggable="true" :multiple="true" @tag="multipleTagRole" id="role_hero" @input="getMatrixX()"> </multiselect>                                                                            
                                </div>                                
                                <div class="form-group" >
                                    <label for="speciality_hero">Speciality Hero</label>
                                    <multiselect v-model="w['speciality']" :options="specialityOption"  :taggable="true" :multiple="true" @tag="multipleTagRole" id="speciality_hero" @input="getMatrixX()"> </multiselect>                                    
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group mt-3" >
                            <button class="btn btn-primary btn-sm">Hitung</button>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="col-7 col-xs-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Matrix X</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama Hero</th>
                                        <th v-for="(bobot, index) in bobot_preferensi" :key="index">
                                            {{ bobot.label }}
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m, index) in matrixX" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td> {{ m.data.nama }} </td>
                                            <td v-for="(nilai, idx) in m.nilai" :key="idx">
                                                {{ nilai }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
  getterType: 'role/getField',
  mutationType: 'role/UPDATE_FIELD',
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
    },    
    befordCreated(){
        
    },
    created(){
        this.init();        
        
    },
    methods:{
        init()
        {   var bobot = {}
            let parent = this
            this.$store.dispatch('kriteria/getAllKriteria').then((response)=>{                
                parent.kriterias = response
                parent.kriterias.forEach(function(k){
                        var field = k.kriteria_field
                        parent.w[field] = 50       
                        bobot[field] = 50                 
                });                         
                this.$store.dispatch('electre/sendBobot', bobot).then((response)=>{
                    parent.matrixX = response.matrix_X
                    parent.bobot_preferensi = response.bobot_preferensi
                    // console.log(parent.matrixX)
                })     
            })
            
            this.$store.dispatch('role/getAllRole').then((response)=>{             
                
                response.forEach(function(res, index){
                    
                    parent.roleOption.push(res.role_name)                    
                })
                                                
            })

            this.$store.dispatch('speciality/getAllSpeciality').then((response)=>{                
                
                response.forEach(function(res, index){
                    parent.specialityOption.push(res.speciality_name)                                        
                })
                                                                
            })      
                  

        },
        multipleTagRole (newTag) {
            const tag = {
                name: newTag                
            }
            this.options.push(tag)
            this.value.push(tag)
        },
        getMatrixX(bobot = null ){        
            let parent = this    
            let data = {}
            console.log(bobot)
            if(bobot)
            {                
                data = bobot 
                this.$store.dispatch('electre/sendBobot', data).then((response)=>{
                    parent.matrixX = response.matrix_X
                    parent.bobot_preferensi = response.bobot_preferensi
                    // console.log(parent.bobot_preferensi)
                })   
            }else{
                // data = this.w    
                // console.log(this.w)   
                this.$store.dispatch('electre/sendBobot', this.w).then((response)=>{
                    parent.matrixX = response.matrix_X
                    parent.bobot_preferensi = response.bobot_preferensi
                    // console.log(parent.bobot_preferensi)
                })    
            }
            // console.log(data)
            
        },      
        
    },
    data(){
        return{
            kriterias: null,
            bobot_preferensi: null,
            matrixX: null,
            w: {},
            roleOption: [],
            specialityOption: [],            
        }
    }
}
</script>
