<template>
<div class="container">

    <div class="row">
        <div class="col-lg-12 mb-4">
            <router-link :to="{ name: 'createSchedule' }" class="btn btn-sucess"
                ><i class="fas fa-plus-circle"></i> Nuevo</router-link
            >
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table id="schedule_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Id</th>
                            <th>Fecha Clase</th>
                            <th>Nombre Alumno</th>
                            <th>Motivo Falta</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="classe in classes" :key="classe.id">
                            <td>{{ classe.id }}</td>
                            <td>
                                {{ classe.fecha_clase }}
                            
                            </td>
                             <td>
                                {{ classe.nombre }}
                            
                            </td>
                            <td>
                                {{ classe.motivo_falta }}
                               
                            </td>

                            <td>
                                <!-- llamamos al componente para Editar     -->
                               <button class="btn btn-primary"  @click="CambioClase( classe.id,classe.class_id)">
                                   Reasignar

                               </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog"  role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Modificar la clase de: 
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        <span
                                            aria-hidden="true"
                                            @click="showModal = false"
                                            >&times;</span
                                        >
                                    </button>
                                </div>
                                <div class="modal-body">
                          
                                </div>
                     

                                <div class="container" v-if="cambioClase"> 

                                    <div class="form-group">
                                          <label>Mes </label>

                                        <select
                                              v-model="person.month_id"
                                              class="form-control"
                                              name="mes_id"
                                              id="mes_id"
                                              @change="mostrarSemanas($event.target.value)"
                                          >
                                              <option value="" selected
                                                  >Seleccione el Mes</option
                                              >
                                              <option
                                                  value="1"
                                                  >{{month_description}}
                                              </option>
                                              <option
                                                  value="2"
                                                  >{{month_description2}}
                                              </option>
                                          </select>
                                      </div>

                                       <div class="form-group">
                                          <label>Semana </label>

                                          <select
                                              v-model="person.semana_id"
                                              class="form-control"
                                              name="semana_id"
                                              id="semana_id"
                                          >
                                              <option value="" selected
                                                  >Seleccione  La semana</option
                                              >
                                              <option
                                                  v-for="week in weeks"
                                                  :value="week.id"
                                                  :key="week.id"
                                                  >{{ week.description }}
                                              </option>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Profesor </label>

                                          <select
                                              v-model="person.teacher_id"
                                              class="form-control"
                                              name="teacher_id"
                                              id="teacher_id"
                                              @change="mostrarDias($event)"

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
                                     
                                     
                                      <div class="form-group">
                                            <label>Días </label>

                                            <select
                                                v-model="person.day_id"
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
                                      <div class="form-group">
                                            <label>Hora de clase: </label>

                                            <select
                                                class="form-control"
                                                v-model="person.clase_id"
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

                                        
                                      <div class="form-group">
                                          <label>Motivo </label>

                                        <textarea
                                              class="form-control"
                                                v-model="person.motivo"
                                         name="motivo" id="motivo" cols="20" rows="2">

                                        </textarea>
                                      </div>
                                     

                                         <button
                                        type="button"
                                        class="btn btn-success"
                                        @click.prevent="realizarCambio($event)"

                                    >
                                       Guardar Cambio
                                    </button>

                                </div>

                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    name: "pendientes",
    data() {
        return {
            weeks: [],
            months: [],

            classes: [],
            teachers: [],
            days:[],
            clases: [],
            showModal:false,
            cambioClase:false,
              person:{
              pend_id:"",
              first_id:"",
              teacher_id: "",
              day_id: "",
              clase_id: "",
              person_id:"",
              desc_falta:"",
              semana_id:"",
              month_id:"",
              motivo: '',
            month_description:'',
            month_description2:'',
            },
        };
    },
    mounted() {
        this.mostrarPendientes();
        this.mostrarTeachers()
        this.mostrarmes();

    
    },
    methods: {
             mostrarmes(){
            var date = new Date()
            var mes = date.getMonth()
            mes +=1 
            switch(mes) {
            case 1:
                this.month_description= "Enero"
            this.month_description2= "Febrero"
                break;
            case 2:
                this.month_description= "Febrero"
            this.month_description2= "Marzo"
                break;
            case 3:
                this.month_description= "Marzo"
            this.month_description2= "Abril"
                break;
            case 4:
                this.month_description= "Abril"
            this.month_description2= "Mayo"
                break;
            case 5:
                this.month_description= "Mayo"
            this.month_description2= "Junio"
                break;
            case 6:
                this.month_description= "Junio"
            this.month_description2= "Julio"
                break;
            case 7:
                this.month_description= "Julio"
            this.month_description2= "Agosto"
                break;
            case 8:
                this.month_description= "Agosto"
            this.month_description2= "Septiembre"
                break;
            case 9:
                this.month_description= "Septiembre"
            this.month_description2= "Octubre"
                break;
            case 10:
                this.month_description= "Octubre"
            this.month_description2= "Noviembre"
                break;
            case 11:
                this.month_description= "Noviembre"
            this.month_description2= "Diciembre"
                break;
            case 12:
                this.month_description= "Diciembre"
                this.month_description2= "Enero"
                break;

            }

        },
        mostrarPendientes() {
            this.axios
                .get("/api/pendientes")
                .then(response => {
                    this.classes = response.data;
                          $(document).ready( function () {
                    $('#schedule_table').DataTable();
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        },
        CambioClase(id,idClase){
            this.person.pend_id = id
           this.person.first_id = idClase;
            this.showModal=true,
            this.cambioClase=true,
            this.mostrarTeachers();

        },
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

        async mostrarMeses() {
            await this.axios
                .get(`/api/meses`)
                .then(response => {
                    const { Months } = response.data;
                    this.months =Months;
                })
                .catch(error => {
                    console.log(error);
                });
        },

                  async mostrarSemanas($id) {
            var month_id = $id
            await this.axios
                .get(`/api/semanas/${month_id}`)
                .then(response => {
                    const { Weeks } = response.data;
                    this.weeks =Weeks;
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

         async realizarCambio(){
          await this.axios.post("/api/cambio2", this.person)
          .then(response =>{
                 
            },
          ).catch(error => {
                console.log(error);
            });

            this.showModal =false
        this.mostrarPendientes();
        },

    },
    
};
</script>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
</style>
