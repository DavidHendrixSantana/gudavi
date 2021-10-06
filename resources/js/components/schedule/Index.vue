<template>
<div class="row">
    <div class="col-lg-12 mb-4">
        <router-link :to='{name:"createSchedule"}' class="btn btn-sucess"><i class="fas fa-plus-circle"></i>  Nuevo</router-link>
    </div>

  <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Hora Inicio</th>
                                    
                         
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="schedule in schedules" :key="schedule.id">
                                    <td>{{ schedule.id }}</td>
                                    <td>{{ schedule.Hora_inicio }}</td>
                                   
                                
                                    <td>
                                        <!-- llamamos al componente para Editar     -->
                                        <router-link :to='{name:"editSchedule",params:{id:schedule.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                       
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
    name:"schedules",
    data(){
        return{
            schedules:[]
        }
    },
    mounted(){
        this.mostrarSchedules()
    },
    methods:{
        mostrarSchedules(){
            this.axios.get('/api/schedule').then(response=>{
               this.schedules = response.data
            }).catch(error=>{
                console.log(error)
            })
        }
    }

}
</script>
