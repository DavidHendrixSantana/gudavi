<template>
<div class="fondo" >
    <header>

    </header>
<div class="row" style="padding-left:2%;">
           
    <br>
      <div class="row" style=" padding-top:30px; width:80%;">
       
            <div class="col-md-6" v-for="month in months" :key="month.id" style="padding-left:60px; width:80%;" >
              <div class="row" style=" width:80%;">
                <div class="col-12" style=" width:80%;">
                    <button type="button" style=" width:100%;" class="btn btn-primary btn-lg" data-bs-toggle="button" v-on:click="asignarMes(month.id)" >Mes de: {{month.description}}</button>
                </div>
              </div>
            </div>       
        </div>
        <br>

        <div class="row" style=" padding-top:30px; width:80%;">
       
            <div class="col-md-6"  style="padding-left:60px; width:80%;" >
                    <button type="button" style=" width:100%;" class="btn btn-primary btn-lg" data-bs-toggle="button" v-on:click=" mostrarDatos(2,1,'M')" >Matutino</button>
            </div>      
            <div class="col-md-6"  style="padding-left:60px; width:80%;" >
                    <button type="button" style=" width:100%;" class="btn btn-primary btn-lg" data-bs-toggle="button" v-on:click=" mostrarDatos(2,1,'V')" >Vespertino</button>
            </div>      

        </div>
    <br>
    <div  style="padding-left:70px; padding-top:30px; width:80%;">
        <div class="row" style="padding:0px; margin:0px;">
                <div class="col-lg-2 col-md-3 col-sm-12" v-for="teacher in Teachers" :key="teacher.id" style="padding:0px; margin:0px;">
                            <div class="row" style="padding-top:10px; padding-bottom:10px;">
                                    <button
                                    style=" width:80%;" 
                                    type="button"
                                    :value="teacher.id"
                                    :id="'teacher-'+teacher.id"
                                    class="button-teacher"
                                    v-on:click="asignarTeacher(teacher.id)"
                                    data-toggle="button"
                                    aria-pressed="false"
                                    autocomplete="off">
                                    {{ teacher.nombre }}
                                </button>

                            </div>
                        
                </div>
        </div>
    </div><br>

        <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-for="teacher in Teachers" :key="teacher.id">
        <input type="radio" class="btn-check" name="btnradio"   v-on:click="cargar_clases($event)" v-model="teacher_id" :id="teacher.id" autocomplete="off">
        <label class="btn btn-outline-primary" for="teacher.id">{{teacher.nombre}}</label> -->

      <div class="row" style=" width:100%;" >
                
              <div class="col-md-2" v-for="week in weeks" :key="week.id"  style="padding-left:5%; width:100%;"> 
                  <div class="row" style=" width:100%;">
                <button type="button"
                  v-on:click="cargar_clases(week.id, week.id, week.first_day, week.last_day, turno)"
                class="btn btn-success " style=" width:200px; height:60px;"  > Semana de : {{week.description}}</button>

                </div>
              

              </div>
        </div>
   
        <br>

        <div class="row">
            <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
                <table class="table-responsive" style="padding-left:30px;">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align:center; padding-top:25px; padding-bottom:15px; border:solid;  background-color:  #006666; color:#ffffff; " v-for="day in Days" :key="day.id">
                                {{ day.Dia }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td v-for="day in Days" :key="day.id" >
                              <div v-for="clase in day.Clases"  :key="clase.id">
                                <div v-if="clase.status == 1"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-1"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 3"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-3"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 4"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-4"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)"
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                <div v-else-if="clase.status == 5"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-5"
                                      
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>

                            <div v-else-if="clase.status == 7"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-7"
                                  

                                      
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                            </div>
                            <div v-else-if="clase.status == 8"  >
                                  <button style="display: block; width:300px;  height: 70px;"
                                      type="button"
                                      class="custom-btn btn-8"
                                      show_modal_grupal
                                      @click="show_modal_grupal(clase.Clase, clase.nombre)"

                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                            </div>
                               
                                <div v-else >
                                  <button style="display: block; width:300px; height: 70px;"
                                      type="button"
                                      class="custom-btn btn-9"
                                      @click="modal_clase_muestra(clase.clase_id)"
                                 
                                    >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                              
                              </div>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                                        Modificar la clase de: {{ person_name }}
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
                                    <p>Acciones en la clase.</p>
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        @click.prevent="noPresentara($event)"

                                    >
                                        No se presentara.
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                        @click.prevent="CambioClase($event)"

                                    >
                                        Solicitar cambio.
                                    </button>
                                </div>
                                <div class="container" v-if="noPresente">
                                  <label for="">Descripción de la falta:</label>
                                  <input class="form-control" v-model="person.desc_falta" type="text">
                                  <label for="">Documento Adjunto:</label>
                                  <input class="form-control" type="file">
                                  <button
                                        type="button"
                                        class="btn btn-info"
                                        @click.prevent="presentarFalta()"

                                    > Registrar Falta
                                    </button>
                                </div> 

                                <div class="container" v-if="cambioClase"> 

                    <div class="row">
                            <div class="col-6 mb-2">
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
                                                  v-for="month in months"
                                                  :value="month.id"
                                                  :key="month.id"
                                                  >{{ month.description }}
                                              </option>
                                          </select>
                                      </div>
                            </div>
                            <div class="col-6 mb-2">
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

                            </div>
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
                                     

                                    <div class="row">
                                 <div class="col-6 mb-2">
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

                                        
                                        </div> 
                                 <div class="col-6 mb-2">
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

                                        </div> 
                                        </div> 
                                      
                                    

                                        
                                      <div class="form-group">
                                          <label>Motivo </label>

                                        <textarea
                                              class="form-control"
                                                v-model="person.motivo"
                                         name="motivo" id="motivo" cols="20" rows="3">

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
        <div v-if="pasarLista">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog"  role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Asistencia
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="pasarLista = false"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div v-if="lista_al" class="modal-body">
                        

                                            <form v-on:submit.prevent="paseLista()" >
                                                <label for="">Pase de lista Alumno:</label>
                                                <input v-model="matricula" type="text">
                                            </form>
                                        
                                        </div>
                                        <div v-if="lista_tea" class="modal-body">
                                       

                                            <form v-on:submit.prevent="paseLista()" >
                                                <label for="">Pase de lista Profesor:</label>
                                                <input v-model="matriculaT" type="text">
                                            </form>
                                        
                                        </div>
                                        

                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
         </div>

         <div v-if="showGrupal">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog"  role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                               Integrantes de la clase de: {{ claseG}}
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="showGrupal = false"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="container">
                                           
                                                    
                                                    <h3> {{grupal}}</h3>
                                        
                                        </div>
                                              
                                        

                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
         </div>
         <div v-if="showMuestra">
                    <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog"  role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                              Clase muestra
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                               

                                            >
                                                <span
                                                    aria-hidden="true"
                                                    @click="showMuestra = false"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                        <div class="container" style="margin:10px;">
                                                Nombre de la persona .
                                                
                                                <input v-model="this.PersonaPrueba" type="text">
                                                <br>
                                                <hr>
                                                <button
                                                type="button"
                                                class="btn btn-primary"
                                                @click="GuardarClaseMuestra()"
                                            >Guardar Clase
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
   </div> 
</template>

<script>
export default {
    name: "Listado",
    data() {
        return {
            teacher_id: 2,
            Days: [],
            Teachers: [],
            showModal: false,
            person_name: "",
            cambioClase:false,
            noPresente:false,
            pasarLista:false,
            lista_al: false,
            lista_tea:false,
            week_id:1,
            month_id:1,
            first_day: 1,
            matricula:"",
            matriculaT:"",
            last_day: 7,
              isActive: true,
              hasError: false,
              activeClass: 'myButton',
              errorClass: 'btn-danger',
              grupal: '',
            claseG: '',
            showGrupal: false,
            turno: "V",
            showMuestra:false,
            
            person:{
              $first_id:"",
              teacher_id: "",
              day_id: "",
              clase_id: "",
              person_id:"",
              desc_falta:"",
              semana_id:"",
              month_id:"",
              motivo: '',
              claseMuestra:'',
              PersonaPrueba:'',
            },
            teachers: [],
            days: [],
            clases: [],
            months: [],
            weeks: [],
            lastId: '',

        };
    },

    mounted() {
        this.mostrarMeses();
        this.mostrarSemanas(1);
        this.mostrarDatos(2,1,'V');
        this.lastTeacher()
    },
 
    methods: {

         async paseLista() {
             var matricula = this.matricula
             var matriculaT = this.matriculaT


             if(this.lista_al){
                      await this.axios
                .get(`/paseLista/${matricula}`)
                .then(response => {
                    console.log('Pase Exitoso')
                })
                .catch(error => {
                    console.log(error);
                });
                 
             }else if(this.lista_tea){

                           await this.axios
                .get(`/paseListaT/${matriculaT}`)
                .then(response => {
         
                    console.log('Pase Exitoso')
                })
                .catch(error => {
                    console.log(error);
                });


             }
                    this.pasarLista = false

       
        },

        asignarTeacher(teacher){
        var id ='teacher-'+this.lastId
        if(this.lastId != ''){
            document.getElementById(`${id}`).classList.remove('button-teacher-t')
            document.getElementById(`${id}`).classList.add('button-teacher')
        }else{
             var id ='teacher-'+this.teacher_id
            document.getElementById(`${id}`).classList.remove('button-teacher-t')
            document.getElementById(`${id}`).classList.add('button-teacher')
            
        }

        this.teacher_id = teacher
           if(this.month_id === 2){
            this.week_id = 6
          }else if(this.month_id === 1){
            this.week_id = 1
          }

        document.getElementById("teacher-"+teacher).classList.toggle('button-teacher-t')
        this.lastId = teacher


         this.cargar_clases(this.week_id, this.month_id, this.first_day, this.last_day, this.turno);


        },
        asignarMes(month_id){
        this.month_id = month_id
          if(this.month_id === 2){
            this.week_id = 6
          }else if(this.month_id === 1){
            this.week_id = 1
          }
          console.log(this.week_id, this.month_id)

        this.cargar_clases(this.week_id,this.month_id, this.first_day, this.last_day,this.turno);
        this.mostrarSemanas(month_id)
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

            async mostrarDatos(teacher, week,turno) {
                this.turno = turno
            await this.axios
                .get(`/api/listado/${teacher}/${week}/${this.turno }`)
                .then(response => {
                    const { Days, Teachers } = response.data;
                    this.Days = Days;
                    this.Teachers = Teachers;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async cargar_clases(week,month, first, last,turno) {
            month =this.month_id
            var teacher = this.teacher_id
            console.log(teacher)
            console.log(week)
            await this.axios
                .get(`/api/listado_teacher/${teacher}/${week}/${month}/${first}/${last}/${turno}`)
                .then(response => {
                    const { Days } = response.data;
                    this.Days = Days;
                })
                .catch(error => {
                    console.log(error);
                });
        },
          async cargar_clases2() {
            await this.axios
                .get(`/api/listado_teacher/${this.teacher_id}`)
                .then(response => {
                    const { Days } = response.data;
                    this.Days = Days;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        show_modal(nombre,id_person, id) {
          console.log(nombre)
          console.log(id_person)
          console.log(id)
            this.person_name=nombre
            this.person.first_id = id;
            this.person.person_id = id_person;
            this.showModal = true;
        },



        show_modal_grupal(clase,grupal) {
            this.claseG =clase
            this.grupal=grupal

            this.showGrupal = true;
        },

        CambioClase(event){
            this.noPresente=false;
            event.preventDefault()
            this.cambioClase=true,
            this.mostrarTeachers();

        },
        
        noPresentara(event){
            this.cambioClase=false,
            event.preventDefault(),
            this.noPresente=true;
        

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
         async lastTeacher() {
            await this.axios
                .get(`/api/lastTeachere`)
                .then(response => {
                    const { teacher } = response.data;
                    console.log('lasteacher:', teacher)
                    this.teacher_id = teacher;
                var id ='teacher-'+teacher
                document.getElementById(`${id}`).classList.remove('button-teacher')
                document.getElementById(`${id}`).classList.add('button-teacher-t')
                
                })
                .catch(error => {
                    console.log(error);
                });
        },

            async mostrarMesesClases() {
            await this.axios
                .get(`/api/person/create`)
                .then(response => {
                    const { Months } = response.data;
                    this.pers = Months;
                    console.log(teachers);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        async mostrarSemanasClases(event) {
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
          await this.axios.post("/api/cambio", this.person)
          .then(response =>{
            const {clase} =response.data;
            console.log(clase);
                    this.cargar_clases(this.week_id,this.month_id, this.first_day, this.last_day,this.turno);
                    this.showModal = false

          })
            .catch(error => {
                console.log(error);
            });
        },

        modal_clase_muestra(clase_id){
            this.claseMuestra=clase_id
            this.showMuestra = true
        },

         async presentarFalta(){
          await this.axios.post("/api/falta", this.person)
          .then(response =>{
            const {respuesta} =response.data;
            console.log(respuesta);
                    this.cargar_clases(this.week_id,this.month_id, this.first_day, this.last_day,this.turno);
                    this.showModal = false

          })
            .catch(error => {
                console.log(error);
            });
        },
        async GuardarClaseMuestra(){
            await this.axios.post( `/guardarClaseMuestra/${this.teacher_id}/${this.claseMuestra}/${this.PersonaPrueba}`)
            .then(response =>{
                const {respuesta} = response.data
            })
            .catch(error =>{
                console.log(error)
            })

        }
    }
};
</script>

<style>
.fondo{
  background: rgba(1, 75, 44, 0.356);
}
.myButton {
	box-shadow:inset 0px 1px 0px 0px #97c4fe;
	background:linear-gradient(to bottom, #3d94f6 5%, #1e62d0 100%);
	background-color:#3d94f6;
	border-radius:6px;
	border:1px solid #337fed;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #1570cd;
}
.myButton:hover {
	background:linear-gradient(to bottom, #1e62d0 5%, #3d94f6 100%);
	background-color:#1e62d0;
}
.myButton:active {
	position:relative;
	top:1px;

}




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
    width: 500px;

}

.modal-body{
    width: 500px;

}




.clase_normal {
    box-shadow: inset 0px -3px 7px 0px #091a22;
    background-color: #11557c;
    border-radius: 3px;
    border: 1px solid #0b0e07;
    width: 180px;
    min-height: 50px;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 15px;
    padding: 12px 37px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #263666;
}
.clase_normal:hover {
    background-color: #02325c;
}
.clase_normal:active {
    position: relative;
    top: 1px;
}

.clase_libre {
    box-shadow: inset 0px -3px 7px 0px #0d3b24;
    background-color: #2b9348;
    border-radius: 3px;
    border: 1px solid #ffffff;
    width: 180px;
    min-height: 50px;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 15px;
    padding: 12px 37px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #263666;
}
.clase_libre:hover {
    background-color: #095309;
}
.clase_libre:active {
    position: relative;
    top: 1px;
}



body {
  background: #e0e5ec;
}
h1 {
  position: relative;
  text-align: center;
  color: #353535;
  font-size: 50px;
  font-family: "Cormorant Garamond", serif;
}

p {
  font-family: 'Lato', sans-serif;
  font-weight: 300;
  text-align: center;
  font-size: 18px;
  color: #676767;
}
.frame {
  width: 90%;
  margin: 40px auto;
  text-align: center;
}
button {
  margin: 20px;
  outline: none;
}
.custom-btn {
  width: 130px;
  height: 40px;
  padding: 10px 25px;
  border: 2px solid #000;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
}

.btn-1{
  background: rgb(8, 51, 92);
  color: rgb(255, 255, 255);

}
.btn-1:hover {
  background: rgb(28, 69, 106);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-2{
  background: rgb(138, 21, 1);
  color: rgb(255, 255, 255);

}

.btn-2:hover {
  background: rgb(68, 0, 0);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-3{
  background: rgb(0, 107, 14);
  color: rgb(255, 255, 255);

}

.btn-3:hover {
  background: rgb(0, 68, 17);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-4{
  background: rgb(0, 176, 240);
  color: rgba(255, 255, 255, 0.63);

}

.btn-4:hover {
  background: rgb(0, 74, 158);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-5{
  background: rgb(128, 128, 128);
  color: rgba(255, 255, 255, 0.63);

}
.btn-5:hover {
  background: rgb(68, 68, 68);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-6{
  background: rgb(204, 102, 255);
  color: rgb(255, 255, 255);

}
.btn-6:hover {
   background: rgb(134, 49, 177);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-7{
  background: hsl(66, 100%, 50%);
  color: rgb(0, 0, 0);

}
.btn-7:hover {
  background: rgba(65, 71, 5, 0.959);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.btn-8{
  background: rgba(0, 32, 96);
  color: rgb(255, 255, 255);


}
.btn-8:hover {
  background: rgb(4, 16, 41);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}
.btn-9{
  background: rgba(255, 255, 255, 0.959);
  color: rgb(0, 0, 0);
  border: solid;

}
.btn-9:hover {
  background: rgb(0, 0, 0);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}



/* CSS */
.button-teacher {
  align-items: center;
  background-clip: padding-box;
  background-color: #095270;
  border: 1px solid transparent;
  border-radius: .25rem;
  box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 16px;
  font-weight: 600;
  justify-content: center;
  line-height: 1.25;
  margin: 0;
  min-height: 3rem;
  padding: calc(.875rem - 1px) calc(1.5rem - 1px);
  position: relative;
  text-decoration: none;
  transition: all 250ms;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  width: auto;
}


.button-teacher:hover {
  transform: translateY(-1px);
}

.button-teacher:active {
  background-color: #c85000;
  box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
  transform: translateY(0);
}

.button-teacher-t {
  align-items: center;
  background-clip: padding-box;
  background-color: #fa6400;
  border: 1px solid transparent;
  border-radius: .25rem;
  box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 16px;
  font-weight: 600;
  justify-content: center;
  line-height: 1.25;
  margin: 0;
  min-height: 3rem;
  padding: calc(.875rem - 1px) calc(1.5rem - 1px);
  position: relative;
  text-decoration: none;
  transition: all 250ms;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  width: auto;
}



</style>
