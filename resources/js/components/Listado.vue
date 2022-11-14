<template>
<div class="fondo" >
    <header>

    </header>


<div class="row ml-3 " >
    <div class="col-2" style="background-color:#FFFFFF">
        <button  @click="modal_clase_muestra()"  class="btn btn-primary btn-lg form-control m-2">Clase Muestra</button>
    </div>
    <div class="col-2" style="background-color:#FFFFFF">

             <button type="button"  class="btn btn-primary btn-lg active form-control m-2" data-bs-toggle="button" v-on:click="asignarMes(1)" >Mes de: {{month_description}}</button>

    </div>
    <div class="col-2" style="background-color:#FFFFFF">
            <button type="button"  class="btn btn-primary btn-lg form-control m-2" data-bs-toggle="button" v-on:click="asignarMes(2)" >Mes de: {{month_description2}}</button>
    </div>
</div>

<div class="row ml-3 " >
    <div class="col-3" style="background-color:#FFFFFF">
        <button type="button"  class="btn btn-primary btn-lg form-control m-2" data-bs-toggle="button" v-on:click=" cargar_horario('M')" >Matutino</button>

    </div>
    <div class="col-3" style="background-color:#FFFFFF">

        <button type="button"  class="btn btn-primary btn-lg form-control m-2" data-bs-toggle="button" v-on:click=" cargar_horario('V')" >Vespertino</button>
    </div>

</div>


                                    <!-- <button  v-for="(teacher, index) in Teachers" :key="teacher.id"
                                    style=" width:80%;" 
                                    type="button"
                                    :value="teacher.id"
                                    :id="'teacher-'+teacher.id"
                                    :class=" index===0 ? 'button-teacher-t' : 'button-teacher'"
                                    v-on:click="asignarTeacher(teacher.id)"
                                    data-toggle="button"
                                    aria-pressed="false"
                                    autocomplete="off">
                                    {{ teacher.nombre }}
                                </button>
  -->
<div class="container btn-group">
</div>
<!-- <div class="container btn-group">
    <div v-for="week in weeks" :key="week.id"  >
    <button type="button" 
                    v-on:click="cargar_clases(week.id, week.description, week.first_day, week.last_day, turno)"
                    class="btn btn-success " style=" width:200px; height:60px; border: solid; border-color:black "  > Semana de : {{week.description}}</button>
    </div>

</div> -->



<div class="row ml-3 " >
    <div class="col-3 p-2" style="background-color:#FFFFFF">
          <label for="" class="font-weight-bold" >Profesores</label>
    <select name="" @change="asignarTeacher($event)" style="width:100%;" class="form-control">
        <option :value="teacher.id"  v-for="(teacher, index) in Teachers" :key="teacher.id"  > {{teacher.nombre}}</option>
    </select>
    </div>
    <div class="col-3 p-2" style="background-color:#FFFFFF">
            <label for="" class="font-weight-bold" >Semanas</label>
    <select name="" @change="cargar_clasesWeek($event)"   class="form-control">
        <option :value="week.id"  style="width:150px;" v-for="week in weeks" :key="week.id"  > {{week.description}}</option>
    </select>
    </div>
</div>




<div  class="row" style="padding-left:1%;" >

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
                                  <button style="display: block; width:150px;  height: 50px;"
                                      type="button"
                                      class="custom-btn btn-1"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 3"  >
                                  <button style="display: block; width:150px;  height: 50px;"
                                      type="button"
                                      class="custom-btn btn-3"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 4"  >
                                  <button style="display: block; width:150px;  height: 50px;"
                                      type="button"
                                      class="custom-btn btn-4"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)"
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                <div v-else-if="clase.status == 5"  >
                                  <button style="display: block; width:150px;  height: 50px;"
                                      type="button"
                                      class="custom-btn btn-5"
                                      
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>

                            <div v-else-if="clase.status == 7"  >
                                  <button style="display: block; width:150px;  height:50px;"
                                      type="button"
                                      class="custom-btn btn-7">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                            </div>
                            <div v-else-if="clase.status == 8"  >
                                  <button style="display: block; width:150px;  height: 50px;"
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
                                  <button style="display: block; width:150px; height: 50px;"
                                      type="button"
                                      class="custom-btn btn-9"
                                 
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
                                                  value="1"
                                                  >{{month_description}}
                                              </option>
                                              <option
                                                  value="2"
                                                  >{{month_description2}}
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
                        

                                            <form  >
                                                <label for="">Pase de lista Alumnos:</label>
                                                <input v-model="matricula" type="text">
                                            </form>
                                            <button class="btn btn-primary" @click="paseLista()" > Pasar Lista</button>
                                        
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
                                        Agregar Clase Muestra:
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
                                <div class="container" > 

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
                                                  value="1"
                                                  >{{month_description}}
                                              </option>
                                              <option
                                                  value="2"
                                                  >{{month_description2}}
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
                                          <label>Nombre de la persona </label>
                                        <br>
                                        <input type="text" style="width:100%;" name="nombrePrueba" v-model="person.nombrePrueba" id="nombrePrueba">
                                      </div>
                                     

                                         <button
                                        type="button"
                                        class="btn btn-success"
                                        @click="saludo()"

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
            lista_al: true,
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
              nombrePrueba: "",

            },
            claseMuestra:{
                teacher_id: "",
                day_id: "",
                clase_id: "",
                semana_id:"",
                 month_id:"",

              },
            PersonaPrueba:'',
            teachers: [],
            days: [],
            clases: [],
            months: [],
            weeks: [],
            lastId: '',
            month_description:'',
            month_description2:'',
            

        };
    },

    mounted() {
        this.mostrarMeses();
        this.mostrarSemanas(1);
        var dat = new Date()
        dat = dat.getDate()
        this.week_id = parseInt(dat/7) + 1
      
        this.mostrarDatos(2,this.week_id,'V');
        this.lastTeacher()
        this.mostrarmes()
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
        async saludo(){
        await this.axios.post(`/guardarClaseMuestra`, this.person)
          .then(response =>{
            const {clase} =response.data;
                    this.cargar_clases(this.week_id,this.month_id, this.first_day, this.last_day,this.turno);
                    this.showMuestra = false
          })
            .catch(error => {
             $.notify("ERROR AL GUARDAR VERIFIQUE QUE HAYA SELECCIONADO TODOS LOS CAMPOS", "error");
            });
        },

        async GuardarClaseMuestra(){

        },
        showPaseModal(){
            this.pasarLista = true
        },
         async paseLista() {
             var matricula = this.matricula
             var matriculaT = this.matriculaT


             if(this.lista_al){
                      await this.axios
                .get(`/paseListaT/${matricula}`)
                .then(response => {
                    console.log(response.data)
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

        asignarTeacher(event){
            const teacher  =event.target.value
            console.log(teacher)

        var id ='teacher-'+this.lastId


        this.teacher_id = teacher
        //    if(this.month_id === 2){
        //     this.week_id = 6
        //   }else if(this.month_id === 1){
        //     this.week_id = 1
        //   }

   
        this.lastId = teacher
        var weekVal =  this.week_id + 1
        this.cargar_clases(weekVal, this.month_id, this.first_day, this.last_day, this.turno);


        },
        asignarMes(month_id){
        this.month_id = month_id
          if(this.month_id === 2){
            this.week_id = 6
          }
          if(this.month_id === 1){
            this.week_id = 1
          }

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
                    this.firtsValue = Weeks[this.week_id].first_day
                    this.lastValue = Weeks[this.week_id].last_day
                    

                })
                .catch(error => {
                    console.log( error);
                });
        },

            async mostrarDatos(teacher, week,turno) {
                this.turno = turno
                var teacher_act = this.teacher_id
            await this.axios
                .get(`/api/listado/${teacher_act}/${week}/${this.turno }`)
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


         
            for (let index = 0; index < this.weeks.length; index++) {
                var verify = this.weeks[index].id
                if(week === verify){
                    this.firtsValue =this.weeks[index].first_day 
                    this.lastValue =this.weeks[index].last_day 
                }
                
            }
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
        async cargar_clasesWeek(event) {
            const week = event.target.value
            console.log(week)
            var teacher = this.teacher_id


         
            for (let index = 0; index < this.weeks.length; index++) {
                var verify = this.weeks[index].id
                if(week === verify){
                    console.log(week)

                    this.firtsValue =this.weeks[index].first_day 
                    this.lastValue =this.weeks[index].last_day 
                }
                
            }
            await this.axios
                .get(`/api/listado_teacher/${teacher}/${week}/${this.month_id}/${this.firtsValue}/${this.lastValue}/${this.turno}`)
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
        cargar_horario(horario){
            this.turno = horario
         this.cargar_clases(this.week_id, this.month_id, this.first_day, this.last_day, this.turno);



        },

        show_modal(nombre,id_person, id) {
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

        modal_clase_muestra(){
            this.showMuestra = true
            this.mostrarTeachers();
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

    }
};
</script>

<style>
#first_nav{
    background-color:#000000;
}

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
	font-size:10px;
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
    font-size: 10px;
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
    font-size: 10px;
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
  width: 80px;
  height: 40px;
  padding: 10px 25px;
  border: 2px solid #000;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  font-size: 10px;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
}

.btn-1{
  background: rgb(8, 51, 92);
  color: rgb(255, 255, 255);
  font-size: 10px;


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
  background: rgb(84, 118, 185);
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
.btn-10{
  background: #5912cac4;
  color: rgb(255, 255, 255);
  border-radius: 10px;

}
.btn-10:hover {
  background: rgb(109, 60, 106);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

.custom-btn2 {

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
