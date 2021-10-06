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
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Día inicio</label>
                                    <select class="form-control" name="Dia_inicio" id="Dia_inicio" v-model="schedule.Dia_inicio" >
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miercoles">Miercoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sabado">Sabado</option>
                                        <option value="Domingo">Domingo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Día Final</label>
                                    <select class="form-control" name="Dia_final" id="Dia_final" v-model="schedule.Dia_final" >
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miercoles">Miercoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sabado">Sabado</option>
                                        <option value="Domingo">Domingo</option>
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
    name:"create-schedule",
    data(){
        return {
            schedule:{
                Hora_inicio:"",
                Hora_final:"",
                Dia_inicio:"",
                Dia_final:"",
            }
        }
    },
    methods:{
              

        async crear(){
            await this.axios.post('/api/schedule',this.schedule).then(response=>{
              
                this.$router.push({name:"indexSchedule"})
            }).catch(response=>{
           
            })
        }
    }
}
</script>