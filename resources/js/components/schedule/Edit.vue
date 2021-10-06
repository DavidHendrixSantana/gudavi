
<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Horario</h4></div>
                <div class="card-body">
                    <form @submit.prevent="actualizar">
                         <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Hora Inicio</label>
                                    <input type="time" class="form-control" v-model="schedule.Hora_inicio">
                                </div>
                            </div>
                          
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"editar-schedule",
    data(){
        return {
            schedule:{
                Hora_inicio:"",
           
            }
        }
    },
    mounted(){
        this.mostrarschedule()
    },
    methods:{
        async mostrarschedule(){
            await this.axios.get(`/api/schedule/${this.$route.params.id}`).then(response=>{
                const { Hora_inicio} = response.data
                this.schedule.Hora_inicio = Hora_inicio
                
            }).catch(error=>{
                console.log(error)
            })
        },
        async actualizar(){
            await this.axios.put(`/api/schedule/${this.$route.params.id}`,this.schedule).then(response=>{
                this.$router.push({name:"indexSchedule"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>