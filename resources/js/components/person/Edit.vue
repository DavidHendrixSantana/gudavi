<template>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Alumno:</h4></div>
                <div class="card-body">
                    <form @submit.prevent="actualizar">
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
                                        value="2021-01-01"
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
                                            <label>Categoria de nado: </label>

                                            <select
                                                v-model="person.categoria"
                                                class="form-control"
                                        
                                                name="categoria"
                                                id="categoria"
                                            >
                                            <option value="">Seleccione la categoria</option                                        >
                                            <option value="Nado normal">Nado normal</option>
                                            <option value="Matronatación">Matronatación</option>
                                            <option value="Acuazumba">Acuazumba</option>
                                            <option value="Spin Acuatico">Spin Acuatico</option>
                                            
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
                                        @change="clase_precio()"
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
                        </div>

                         <div class="row">

                         <div class="col-6">
                                <div class="form-group">
                                    <label>Clases Semanales: </label>
                                    <select
                                        name="clases"
                                        id="clases"
                                        v-model="person.clases_semanales"
                                        class="form-control"
                                        @change="clase_precio()"

                                        
                                    >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      
                                        >
                                    </select>
                                </div>
                                       
                            </div>

                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label>Monto a pagar.</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="person.clases_precio"
                                            
                                            
                                        />
                                    </div>
                                </div>
                                
                                    
                        </div>
                            <div>
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id_1"
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


                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_1"
                                                class="form-control"
                                                @change="mostrarClases($event, person.teacher_id_1)"
                                            >
                                                <option value="" selected
                                                    >Seleccione el Día</option
                                                >
                                                <option
                                                    v-for="day in days_1"
                                                    :value="day.id"
                                                    :key="day.id"
                                                    >{{ day.Dia }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                                    v-for="clase in clases_1"
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

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id_2"
                                            class="form-control"
                                            @change="mostrarDias2($event)"
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


                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_2"
                                                class="form-control"
                                                @change="mostrarClases2($event, person.teacher_id_2)"
                                            >
                                                <option value="" selected
                                                    >Seleccione el Día</option
                                                >
                                                <option
                                                    v-for="day in days_2"
                                                    :value="day.id"
                                                    :key="day.id"
                                                    >{{ day.Dia }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                                    v-for="clase in clases_2"
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

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id_3"
                                            class="form-control"
                                            @change="mostrarDias3($event)"
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

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_3"
                                                class="form-control"
                                                @change="mostrarClases3($event, person.teacher_id_3)"
                                            >
                                                <option value="" selected
                                                    >Seleccione el Día</option
                                                >
                                                <option
                                                    v-for="day in days_3"
                                                    :value="day.id"
                                                    :key="day.id"
                                                    >{{ day.Dia }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                                    v-for="clase in clases_3"
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


                                    <div class="col-4">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id_4"
                                            class="form-control"
                                            @change="mostrarDias4($event)"
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

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_4"
                                                class="form-control"
                                                @change="mostrarClases4($event,  person.teacher_id_4)"
                                            >
                                                <option value="" selected
                                                    >Seleccione el Día</option
                                                >
                                                <option
                                                    v-for="day in days_4"
                                                    :value="day.id"
                                                    :key="day.id"
                                                    >{{ day.Dia }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                                    v-for="clase in clases_4"
                                                    :value="clase.id"
                                                    :key="clase.id"
                                                    >{{ clase.Clase }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="show2" v-if="person.clases_semanales >= 5">
                                <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Profesor </label>

                                        <select
                                            v-model="person.teacher_id_5"
                                            class="form-control"
                                            @change="mostrarDias5($event)"
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

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id_5"
                                                class="form-control"
                                                @change="mostrarClases5($event, person.teacher_id_5)"
                                            >
                                                <option value="" selected
                                                    >Seleccione el Día</option
                                                >
                                                <option
                                                    v-for="day in days_5"
                                                    :value="day.id"
                                                    :key="day.id"
                                                    >{{ day.Dia }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                                    v-for="clase in clases_5"
                                                    :value="clase.id"
                                                    :key="clase.id"
                                                    >{{ clase.Clase }}
                                                </option>
                                            </select>
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
                                    actualizar
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
    name: "editPerson",
    data() {
        return {
            person: {
                id:"",
                nombre: "",
                fecha_nacimiento: "",
                edad: "",
                nombre_papa: "",
                telefono_papa: "",
                nombre_mama: "",
                telefono_mama: "",
                correo_electronico: "",
                nombre_emergencia: "",
                clases_semanales: "1",
                telefono_emergencia: "",
                mesesPagados: '1',
                fecha_inicio: "2021-01-01",
                enfermedad: "",
                nivel: "Mayor2",
                clases_precio: 200,
                teacher_id_1: "",
                teacher_id_2: "",
                teacher_id_3: "",
                teacher_id_4: "",
                teacher_id_5: "",
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
                categoria:"",
            },
            nivel_nado: "",
            teachers: [],
            days: [],
            days_1: [],
            days_2: [],
            days_3: [],
            days_4: [],
            days_5: [],
            clases_1: [],
            clases_2: [],
            clases_3: [],
            clases_4: [],
            clases_5: [],
            last_teacher:"",
        };
    },
    mounted() {
        this.mostrarTeachers();
        this.mostrarperson()

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
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_1 = days;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarDias2(event) {
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_2 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarDias3(event) {
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_3 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarDias4(event) {
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_4 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarDias5(event) {
            
            await this.axios
                .get(`/person/ShowDays/${event.target.value}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_5 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },

        async mostrarClases(event, id_1) {
            var dia_id = event.target.value;
            var teacher_id = this.person.teacher_id;
            console.log(dia_id);

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_1 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarClases2(event, id_1) {
            var dia_id = event.target.value;
            var teacher_id = this.person.teacher_id;

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_2 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
            async mostrarClases3(event, id_1) {

            var dia_id = event.target.value;
            var teacher_id = this.person.teacher_id;

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_3 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
                async mostrarClases4(event, id_1) {
            var dia_id = event.target.value;
            var teacher_id = this.person.teacher_id;

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_4 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarClases5(event, id_1) {
            var dia_id = event.target.value;
            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_5 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async crear() {
           

            await this.axios.post("/api/person", this.person)
                 .then(response => {
                      this.$router.push({ name: "indexPerson" })
                })
                .catch(error => {
                    console.log(error);
                });
          
        },

        
        async CargarDias() {
        var teacher = this.person.teacher_id_1
            await this.axios
                .get(`/person/ShowDays/${teacher}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_1 = days;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarDias2() {
             var teacher = this.person.teacher_id_2

            await this.axios
                .get(`/person/ShowDays/${teacher}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_2 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarDias3() {
             var teacher = this.person.teacher_id_3

            await this.axios
                .get(`/person/ShowDays/${teacher}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_3 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarDias4() {
             var teacher = this.person.teacher_id_4
             await this.axios
                .get(`/person/ShowDays/${teacher}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_4 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarDias5() {
             var teacher = this.person.teacher_id_5            
            await this.axios
                .get(`/person/ShowDays/${teacher}`)
                .then(response => {
                    const { days } = response.data;
                    this.days_5 = days;

                })
                .catch(error => {
                    console.log(error);
                });
        },

            async CargarClases() {
            var dia_id = this.person.clase_id_1
            var id_1 = this.person.teacher_id_1
            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_1 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarClases2(event, id_1) {
        var dia_id = this.person.clase_id_2
            var id_1 = this.person.teacher_id_2

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_2 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
            async CargarClases3(event, id_1) {

        var dia_id = this.person.clase_id_3
            var id_1 = this.person.teacher_id_3
            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_3 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
            async CargarClases4(event, id_1) {
          var dia_id = this.person.clase_id_4
            var id_1 = this.person.teacher_id_4

            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_4 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async CargarClases5() {
            var dia_id = this.person.clase_id_5
            var id_1 = this.person.teacher_id_5
            await this.axios
                .get(`/person/ShowClasses/${dia_id}/${id_1}`)
                .then(response => {
                    const { clases } = response.data;
                    this.clases_5 = clases;
                    console.log(clases);
                })
                .catch(error => {
                    console.log(error);
                });
        },


        nivel_precio(event) {
            this.nivel_nado = event.target.value;
            this.clase_precio()

        },

        clase_precio() {
            var dias = this.person.clases_semanales;
            var meses =this.person.mesesPagados

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
                } else if (dias == 4) {
                    this.person.clases_precio =(meses* 1450) + 200;
                } else if (dias == 5) {
                    this.person.clases_precio =(meses* 1750) + 200;
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
        
        },

        async mostrarperson(){
            await this.axios.get(`/api/person/${this.$route.params.id}`).then(response=>{
                const { 
                id,
                nombre,
                fecha_nacimiento,
                edad,
                nombre_papa,
                telefono_papa,
                nombre_mama,
                telefono_mama,
                correo_electronico,
                nombre_emergencia,
                telefono_emergencia,
                fecha_inicio,
                enfermedad,
                nivel,
                clases_semanales,
                categoria,
                mesesPagados,
                clases_precio,
                teacher_id_1,
                teacher_id_2,
                teacher_id_3,
                teacher_id_4,
                teacher_id_5,
                day_id_1,
                day_id_2,
                day_id_3,
                day_id_4,
                day_id_5,
                clase_id_1,
                clase_id_2,
                clase_id_3,
                clase_id_4,
                clase_id_5,
                } = response.data
                this.person.id =id 
                this.person.nombre =nombre 
                this.person.fecha_nacimiento =fecha_nacimiento 
                this.person.edad =edad 
                this.person.nombre_papa =nombre_papa 
                this.person.telefono_papa =telefono_papa 
                this.person.nombre_mama =nombre_mama 
                this.person.telefono_mama =telefono_mama 
                this.person.correo_electronico =correo_electronico 
                this.person.nombre_emergencia =nombre_emergencia 
                this.person.telefono_emergencia =telefono_emergencia 
                this.person.fecha_inicio =fecha_inicio 
                this.person.clases_semanales =clases_semanales
                this.person.mesesPagados =1
                this.person.enfermedad =enfermedad 
                this.person.nivel =nivel 
                this.person.categoria =categoria 
                this.person.clases_precio =clases_precio 
                this.person.teacher_id_1 = teacher_id_1
                this.person.teacher_id_2 = teacher_id_2
                this.person.teacher_id_3= teacher_id_3
                this.person.teacher_id_4 = teacher_id_4
                this.person.teacher_id_5 = teacher_id_5
                this.person.day_id_1=day_id_1
                this.person.day_id_2=day_id_2
                this.person.day_id_3=day_id_3
                this.person.day_id_4=day_id_4
                this.person.day_id_5=day_id_5
                this.person.clase_id_1=clase_id_1
                this.person.clase_id_2=clase_id_2
                this.person.clase_id_3=clase_id_3
                this.person.clase_id_4=clase_id_4
                this.person.clase_id_5=clase_id_5
                console.log(response.data)

        this.CargarDias()
        this.CargarDias2()
        this.CargarDias3()
        this.CargarDias4()
        this.CargarDias5()
        this.CargarClases()
        this.CargarClases2()
        this.CargarClases3()
        this.CargarClases4()
        this.CargarClases5()
    
            }).catch(error=>{
                console.log(error)
            })
        },
        async actualizar(){
            await this.axios.put(`/api/actualizarPersona`,this.person).then(response=>{
                this.$router.push({name:"indexPerson"})
            }).catch(error=>{
                console.log(error)
            })
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