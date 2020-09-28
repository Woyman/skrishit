import Dashboard from '../components/ExampleComponent.vue'
import Role from '../components/role/RoleListComponent.vue'
import Speciality from '../components/speciality/SpecialityListComponent.vue'
    
export default [

	{
		path : '/',
		name : 'dashboard',
        meta : { 
                 name : 'Dashboard',                                   
                 title : 'Dashboard',                    
               },
    component : Dashboard,
  
  },     
  {
		path : '/role',
		name : 'admin.role',
        meta : { 
                 name : 'Role',                                   
                 title : 'Role',                    
               },
    component : Role,  
  },    
  {
		path : '/speciality',
		name : 'admin.speciality',
        meta : { 
                 name : 'Speciality',                                   
                 title : 'Speciality',                    
               },
    component : Speciality,  
  },     
  
];    
