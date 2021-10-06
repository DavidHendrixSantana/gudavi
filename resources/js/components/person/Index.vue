<template>
<div class="row">
    <div class="col-lg-12 mb-4">
        <router-link :to='{name:"createPerson"}' class="btn btn-sucess"><i class="fas fa-plus-circle"></i>  Nuevo</router-link>
    </div>

  <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                   
                         
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="person in Persons" :key="person.id">
                                    <td>{{ person.id }}</td>
                                    <td>{{ person.nombre }}</td>
                                  
                                    <td>
                                        <!-- llamamos al componente para Editar     -->
                                        <router-link :to='{name:"editPerson",params:{id:person.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                       
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>                          
        </div>

</div>
    
</template>

<script>


export default {
    name:"persons",
    data(){
        return{
            Persons:[]
        }
    },
    mounted(){
        this.mostrarPersons()
    },
    methods:{
        mostrarPersons(){
            this.axios.get('/api/person').then(response=>{
               this.Persons = response.data
            }).catch(error=>{
                console.log(error)
            })
        }
    }

}
</script>
