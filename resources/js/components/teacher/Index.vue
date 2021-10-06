<template>
<div class="row">
    <div class="col-lg-12 mb-4">
        <router-link :to='{name:"createTeacher"}' class="btn btn-sucess"><i class="fas fa-plus-circle"></i>  Nuevo</router-link>
    </div>

  <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Turno</th>
                         
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="teacher in Teachers" :key="teacher.id">
                                    <td>{{ teacher.id }}</td>
                                    <td>{{ teacher.nombre }}</td>
                                    <td>{{ teacher.turno }}</td>
                                
                                    <td>
                                        <!-- llamamos al componente para Editar     -->
                                        <router-link :to='{name:"editTeacher",params:{id:teacher.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                       
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
    name:"teachers",
    data(){
        return{
            Teachers:[]
        }
    },
    mounted(){
        this.mostrarTeachers()
    },
    methods:{
        mostrarTeachers(){
            this.axios.get('/api/teacher').then(response=>{
               this.Teachers = response.data
            }).catch(error=>{
                console.log(error)
            })
        }
    }

}
</script>
