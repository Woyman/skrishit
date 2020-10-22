<template>
    <!-- <div class="container"> -->
        <div class="row col-12 justify-content-center">
            <div class="col-7 col-xs-12 mt-3 ">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ pageTitle }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                             
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
            matrix_x: 'electre/getMatrixX'
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
            console.log(this.matrix_x)
        },       
        
    },
    data(){
        return{
           a:[]   
        }
    }
}
</script>
