<template>
<div class="container">
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
                                    <label>Tipo de nado: </label>
                                    <select
                                        name="nivel"
                                        id="nivel"
                                        v-model="person.nivel"
                                        class="form-control"
                                        @change="nivel_precio($event)"
                                    >
                                        <option value=""
                                            >Seleccione el nivel</option
                                        >
                                        <option value="Bebes">Bebes</option>
                                        <option value="Mayor2"
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
                                        name="clases"
                                        id="clases"
                                        v-model="person.clases_semanales"
                                        class="form-control"
                                        
                                    >
                                        <option value=""
                                            >Seleccione los días</option
                                        >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option
                                            v-if="person.nivel === 'Grupales'"
                                            value="5"
                                            >5</option
                                        >
                                    </select>
                                </div>
                            </div>
                             <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Meses a pagar: </label>
                                    <select
                                        name="clases"
                                        id="clases"
                                        v-model="person.mesesPagados"
                                        class="form-control"
                                        @change="clase_precio($event)"
                                    >
                                        <option value=""
                                            >Seleccione los meses</option
                                        >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                     
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Monto a pagar.</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="person.clases_precio"
                                        disabled
                                        
                                    />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id"
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Categoria de nado: </label>

                                        <select
                                            v-model="person.categoria"
                                            class="form-control"
                                    
                                            name="categoria"
                                            id="categoria"
                                        >
                                           
                                        <option value="Nado normal">Nado normal</option>
                                        <option value="Matronatación">Matronatación</option>
                                        <option value="Acuazumba">Acuazumba</option>
                                        <option value="Spin Acuatico">Spin Acuatico</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_1"
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

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id_1"
                                            >
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
                            <div id="show1" v-if="person.clases_semanales >= 2">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_2"
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

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id_2"
                                            >
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
                            <div id="show2" v-if="person.clases_semanales >= 3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_3"
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

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id_3"
                                            >
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
                            <div id="show2" v-if="person.clases_semanales >= 4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_4"
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

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id_4"
                                            >
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
                            <div id="show2" v-if="person.clases_semanales == 5">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_5"
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

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id_5"
                                            >
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
                        </div>
                        <div class="row">
                            <div class="col-12"><br /></div>

                            <div class="col-10"></div>
                            <div class="col-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg"
                                >
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
                clases_semanales: "",
                telefono_emergencia: "",
                mesesPagados: '',
                fecha_inicio: "",
                enfermedad: "",
                nivel: "",
                clases_precio: 200,
                day_id_1: "",
                day_id_2: "",
                day_id_3: "",
                day_id_4: "",
                day_id_5: "",
                clase_id_1: "",
                clase_id_2: "",
                clase_id_3: "",
                clase_id_4: "",
                clase_id_5: "",
                teacher_id: ""
            },
            nivel_nado: "",
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
            console.log(this.person.teacher_id);
            var dia_id = event.target.value;
            var teacher_id = this.person.teacher_id;

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${teacher_id}`)
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
            console.log(this.person.clases_semanales);

            await this.axios.post("/api/person", this.person)
            this.$router.push({ name: "indexPerson" }).catch(error => {
                console.log(error);
            });
        },

        nivel_precio(event) {
            this.nivel_nado = event.target.value;
        },

        clase_precio(event) {
            var dias = this.person.clases_semanales;
            var meses =event.target.value

            if (this.nivel_nado === "Bebes") {

                if (dias == 1) {
                    this.person.clases_precio =(meses* 650) + 200;

                } else if (dias == 2) {
                    this.person.clases_precio =(meses* 1150) + 200;
                } else if (dias == 3) {
                    this.person.clases_precio =(meses* 1550) + 200;
                }
            }
            if (this.nivel_nado === "Mayor2") {
                if (dias == 1) {
                    this.person.clases_precio =(meses* 550) + 200;
                } else if (dias == 2) {
                    this.person.clases_precio =(meses* 850) + 200;
                } else if (dias == 3) {
                    this.person.clases_precio =(meses* 1150) + 200;
                }
            }
            if (this.nivel_nado === "Grupales") {
                if (dias=== 1) {
                    this.person.clases_precio = (meses*600) + 200;
                } else if (dias == 2) {
                    this.person.clases_precio =(meses*790) + 200;
                } else if (dias == 3) {
                    this.person.clases_precio = (meses*850) + 200;
                } else if (dias == 5) {
                    this.person.clases_precio =(meses* 1200) + 200;
                }
            }
        
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