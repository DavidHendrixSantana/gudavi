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
                                    <label>Nombre del profesor: </label>
                                    <input type="text" class="form-control" v-model="teacher.nombre">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Turno </label>
                                    <input type="text" class="form-control" v-model="teacher.turno">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Telefono </label>
                                    <input type="number" class="form-control" v-model="teacher.telefono">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Horario </label>

                                    <select v-model="teacher.schedule_id" name="teacher_id" id="teacher_id">
                                        <option v-for="schedule in schedules" :value="schedule.id" :key="schedule.id"> {{schedule.Hora_inicio}}</option>
                                    </select>
                                    
                                
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
    name:"create-teacher",
    data(){
        return {
            teacher:{
                nombre:"",
                turno:"",
                telefono:"",
                schedule_id:"",
            },
            schedules:[],
            
        }
    },
   

    mounted(){
        this.mostrarschedules()
    },
    methods:{
    async mostrarschedules(){
                await this.axios.get(`/api/teacher/create`).then(response=>{
                    const { schedules} = response.data
                    this.schedules = schedules
                 console.log(schedules)
                  
                }).catch(error=>{
                    console.log(error)
                })
            },

        async crear(){
            console.log(this.teacher.schedule_id)
            await this.axios.post('/api/teacher',this.teacher).then(response=>{
                this.$router.push({name:"indexTeacher"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>