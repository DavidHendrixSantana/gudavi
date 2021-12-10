
<template>
 <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Profesor</h4></div>
                <div class="card-body">
                    <form @submit.prevent="actualizar">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Nombre del profesor: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.nombre"
                                    />
                                </div>
                            </div>
                             <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Primer apellido: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.primer_apellido"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Segundo apellido: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.segundo_apellido"
                                    />
                                </div>
                            </div>

                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>RFC: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.rfc"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Tarjeta de pago: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.tarjeta"
                                    />
                                </div>
                            </div>
                               <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Contacto de emergencia: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="teacher.emergencia"
                                    />
                                </div>
                            </div>
                            
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Telefono </label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="teacher.telefono"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Horario </label>

                                    <select
                                    class="form-control"
                                        v-model="teacher.schedule_id"
                                        name="teacher_id"
                                        id="teacher_id"
                                    >
                                        <option
                                            v-for="schedule in schedules"
                                            :value="schedule.id"
                                            :key="schedule.id"
                                            >{{ schedule.Dia_inicio +'  - '+  schedule.Dia_final }}
                                           
                                            </option
                                        >
                                    </select>
                                </div>
                            </div>
                             <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Pago por hora </label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="teacher.pago_hora"
                                    />
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
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
    name:"editar-teacher",
    data(){
        return {
            teacher:{
                id: "",
                nombre: "",
                primer_apellido:"",
                segundo_apellido:"",
                rfc:"",
                tarjeta:"",
                emergencia:"",
                telefono: "",
                schedule_id: "",
                pago_hora:"",
            },
            schedules:[],
        }
    },
    mounted(){
           this.mostrarschedules();
        this.mostrarteacher()
    },
    methods:{

    async mostrarschedules() {
            await this.axios
                .get(`/api/teacher/create`)
                .then(response => {
                    const { schedules } = response.data;
                    this.schedules = schedules;
                    console.log(schedules);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarteacher(){
            await this.axios.get(`/api/teacher/${this.$route.params.id}`).then(response=>{
                const { 
                    id,
                    nombre,
                primer_apellido,
                segundo_apellido,
                telefono, 
                rfc,
                tarjeta,
                emergencia,
                pago_hora,
                schedule_id,
                 } = response.data.Teacher
                this.teacher.id = id
                this.teacher.nombre = nombre
                this.teacher.primer_apellido = primer_apellido
                this.teacher.segundo_apellido = segundo_apellido
                this.teacher.rfc = rfc
                this.teacher.tarjeta = tarjeta
                this.teacher.telefono = telefono
                this.teacher.emergencia = emergencia
                this.teacher.pago_hora = pago_hora
                this.teacher.schedule_id =  schedule_id
                
            }).catch(error=>{
                console.log(error)
            })
        },
        async actualizar(){
            await this.axios.put(`/api/teacher/${this.$route.params.id}`,this.teacher).then(response=>{
                this.$router.push({name:"indexTeacher"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>