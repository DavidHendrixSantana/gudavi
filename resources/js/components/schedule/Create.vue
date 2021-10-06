<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Horario</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Hora Inicio</label>
                                    <input type="time" class="form-control" v-model="schedule.Hora_inicio">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Hora final</label>
                                    <input type="time" class="form-control" v-model="schedule.Hora_final">

                                

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
    name:"create-schedule",
    data(){
        return {
            schedule:{
                Hora_inicio:"",
                Hora_final:""
            }
        }
    },
    methods:{
        async crear(){
            await this.axios.post('/api/schedule',this.schedule).then(response=>{
              
                this.$router.push({name:"indexSchedule"})
            }).catch(response=>{
                console.log(response.error)
            })
        }
    }
}
</script>