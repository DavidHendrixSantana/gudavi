<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Horario</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Hora Inicio</label>
                                      <select class="form-control" name="Dia_inicio" id="Dia_inicio" v-model="schedule.Hora_inicio" >
                                        <option value="9.0">09:00</option>
                                        <option value="9.5">09:30</option>
                                        <option value="10.0">10:00</option>
                                        <option value="10.5">10:30</option>
                                        <option value="11.0">11:00</option>
                                        <option value="11.5">11:30</option>
                                        <option value="12.0">12:00</option>
                                        <option value="12.5">12:30</option>
                                        <option value="13.0">13:00</option>
                                        <option value="13.5">13:30</option>
                                        <option value="14.0">14:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Hora final</label>
                                <select class="form-control" name="Dia_inicio" id="Dia_inicio" v-model="schedule.Hora_final" >
                                        <option value="15.0">15:00</option>
                                        <option value="15.5">15:30</option>
                                        <option value="16.0">16:00</option>
                                        <option value="16.5">16:30</option>
                                        <option value="17.0">17:00</option>
                                        <option value="17.5">17:30</option>
                                        <option value="18.0">18:00</option>
                                        <option value="18.5">18:30</option>
                                        <option value="19.0">19:00</option>
                                        <option value="19.5">19:30</option>
                                        <option value="20.0">20:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Día inicio</label>
                                    <select class="form-control" name="Dia_inicio" id="Dia_inicio" v-model="schedule.Dia_inicio" >
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miercoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sabado</option>
                                        <option value="7">Domingo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Día Final</label>
                                    <select class="form-control" name="Dia_final" id="Dia_final" v-model="schedule.Dia_final" >
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miercoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sabado</option>
                                        <option value="7">Domingo</option>
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

<style >
 label{
     font-size: 18px;
     font-family: "Segoe UI", Arial, sans-serif;
     font-weight: bold;
 }
</style>