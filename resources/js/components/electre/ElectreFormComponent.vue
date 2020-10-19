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
                                    <vue-range ref="slider" v-model="w[kriteria.kriteria_field]"  tooltip="always"></vue-range>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3" >
                            <button class="btn btn-primary btn-sm" @click="submit">Hitung</button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>       

    <!-- </div> -->
</template>

<script>
import VueRangeSlider from 'vue-range-component'
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
        'vue-range' : VueRangeSlider
    },
    computed:{
        pageTitle() {   
            return this.$route.meta.title            
        },
    },
    created(){
        this.init();
    },
    methods:{
        init()
        {
            parent = this
            this.$store.dispatch('kriteria/getAllKriteria').then((response)=>{                
                parent.kriterias = response
                parent.kriterias.forEach(function(k){
                        var field = k.kriteria_field
                        parent.w[field] = 50
                });                                
            })
        },
        submit(){            

            let data = this.w
            // Object.keys(data).forEach( key => {                         
            //         console.log(key, data[key])                     
            // })
            this.$store.dispatch('electre/sendBobot', data).then((response)=>{

            })
        },      
        
    },
    data(){
        return{
            kriterias: null,
            w: {}
        }
    }
}
</script>
