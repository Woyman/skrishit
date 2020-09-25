import Dashboard from '../components/ExampleComponent.vue'
import Role from '../components/role/RoleListComponent.vue'
    
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
  
];    
