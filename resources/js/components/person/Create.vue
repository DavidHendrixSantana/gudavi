<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Crear Alumno:</h4></div>
                <div class="card-body">
                    <form @submit.prevent="crear">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.nombre"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento :</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="person.fecha_nacimiento"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Edad :</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="person.edad"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Nombre del Papá</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.nombre_papa"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Télefono del papá</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="person.telefono_papa"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Nombre de la Mamá</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.nombre_mama"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Télefono de la mamá</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="person.telefono_mama"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.correo_electronico"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label
                                        >En caso de emergencias llamar a:</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.nombre_emergencia"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Telefono (Emergencia) :</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        v-model="person.telefono_emergencia"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Fecha Inicio</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="person.fecha_inicio"
                                    />
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>¿Padece de alguna enfermedad?</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.enfermedad"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Nivel de nado: </label>
                                    <select
                                        name="nivel"
                                        id="nivel"
                                        v-model="person.nivel"
                                        class="form-control"
                                    >
                                        <option value="Bebes">Bebes</option>
                                        <option value="Mayor de 2 anos"
                                            >Mayor de 2 años</option
                                        >
                                        <option value="Grupales"
                                            >Grupales</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Clases Semanales: </label>
                                    <select
                                        name="nivel"
                                        id="nivel"
                                        v-model="person.clases_semanales"
                                        class="form-control"
                                    >
                                        <option value="1">1</option>
                                        <option value="2 ">2</option>
                                        <option value="3">3</option>
                                        <option
                                            v-if="person.nivel === 'Grupales'"
                                            value="5"
                                            >5</option
                                        >
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            class="form-control"
                                            @change="mostrarDias($event)"
                                            name="teacher_id"
                                            id="teacher_id"
                                        >
                                            <option value="" selected
                                                >Seleccione el profesor</option
                                            >
                                            <option
                                                v-for="teacher in teachers"
                                                :value="teacher.id"
                                                :key="teacher.id"
                                                >{{ teacher.nombre }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Días </label>

                                        <select
                                            class="form-control"
                                            @change="mostrarClases($event)"
                                        >
                                            <option value="" selected
                                                >Seleccione el Día</option
                                            >
                                            <option
                                                v-for="day in days"
                                                :value="day.id"
                                                :key="day.id"
                                                >{{ day.Dia }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Hora de clase: </label>

                                        <select class="form-control">
                                            <option value="" selected
                                                >Seleccione la clase</option
                                            >
                                            <option
                                                v-for="clase in clases"
                                                :value="clase.id"
                                                :key="clase.id"
                                                >{{ clase.Clase }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
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
    name: "create-schedule",
    data() {
        return {
            person: {
                nombre: "",
                fecha_nacimiento: "",
                edad: "",
                nombre_papa: "",
                telefono_papa: "",
                nombre_mama: "",
                telefono_mama: "",
                correo_electronico: "",
                nombre_emergencia: "",
                telefono_emergencia: "",
                fecha_inicio: "",
                enfermedad: "",
                nivel: ""
            },
            teachers: [],
            days: [],
            clases: []
        };
    },
    mounted() {
        this.mostrarTeachers();
    },
    methods: {
        async mostrarTeachers() {
            await this.axios
                .get(`/api/person/create`)
                .then(response => {
                    const { teachers } = response.data;
                    this.teachers = teachers;
                    console.log(teachers);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async mostrarDias(event) {
            console.log(event.target.value);
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days = days;
                    console.log(days);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarClases(event) {
            console.log(event.target.value);
            await this.axios
                .get(`/person/ShowClasses/${event.target.value}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async crear() {
            await this.axios
                .post("/api/person", this.person)
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
