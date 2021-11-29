<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Horario</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
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
                                    Guardar
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
    name: "create-teacher",
    data() {
        return {
            teacher: {
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
            schedules: []
        };
    },

    mounted() {
        this.mostrarschedules();
    },
    methods: {
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

        async crear() {
            console.log(this.teacher.schedule_id);
            await this.axios
                .post("/api/teacher", this.teacher)
                .then(response => {
                    this.$router.push({ name: "indexPerson" });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style >
 label{
     font-size: 18px;
     font-family: "Segoe UI", Arial, sans-serif;
     font-weight: bold;
 }
</style>