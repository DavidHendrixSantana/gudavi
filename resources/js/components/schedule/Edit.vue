<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Horario</h4></div>
                <div class="card-body">
                    <form @submit.prevent="Actualizar">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Hora Inicio</label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="schedule.Hora_inicio"
                                    />
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Hora final</label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="schedule.Hora_final"
                                    />
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Día inicio</label>
                                    <select
                                        class="form-control"
                                        name="Dia_inicio"
                                        id="Dia_inicio"
                                        v-model="schedule.Dia_inicio"
                                    >
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3"
                                            >Miercoles</option
                                        >
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
                                    <select
                                        class="form-control"
                                        name="Dia_final"
                                        id="Dia_final"
                                        v-model="schedule.Dia_final"
                                    >
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3"
                                            >Miercoles</option
                                        >
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sabado</option>
                                        <option value="7">Domingo</option>
                                    </select>
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
</template>

<script>
export default {
    name: "editar-schedule",
    data() {
        return {
            schedule: {
                Hora_inicio: "",
                Hora_final: "",
                Dia_inicio: "",
                Dia_final: ""
            }
        };
    },
    mounted() {
        this.mostrarschedule();
    },
    methods: {
        async mostrarschedule() {
            await this.axios
                .get(`/api/schedule/${this.$route.params.id}`)
                .then(response => {
                    const {
                        Hora_inicio,
                        Hora_final,
                        Dia_inicio,
                        Dia_final
                    } = response.data;
                    this.schedule.Hora_inicio = Hora_inicio;
                    this.schedule.Hora_final = Hora_final;
                    this.schedule.Dia_inicio = Dia_inicio;
                    this.schedule.Dia_final = Dia_final;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async actualizar() {
            await this.axios
                .put(`/api/schedule/${this.$route.params.id}`, this.schedule)
                .then(response => {
                    this.$router.push({ name: "indexSchedule" });
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