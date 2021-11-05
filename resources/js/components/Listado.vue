<template>
<div >
    <header>

    </header>
    <div style="margin-left:100; margin-top:15px; margin-bottom:25px;   pading:0px;">
        <div class="row">
            <div class="col-4" v-for="teacher in Teachers" :key="teacher.id">
                <div class="row">
                    <button
                        type="button"
                        v-on:click="cargar_clases($event)"
                        :value="teacher.id"
                        :id="teacher.id"
                        class="custom-btn btn-7 "
                     
                       data-toggle="button"
                        aria-pressed="false"
                        autocomplete="off"
                    >
                        {{ teacher.nombre }}
                    </button>
                </div>
            </div>
        </div>

        <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-for="teacher in Teachers" :key="teacher.id">
        <input type="radio" class="btn-check" name="btnradio"   v-on:click="cargar_clases($event)" v-model="teacher_id" :id="teacher.id" autocomplete="off">
        <label class="btn btn-outline-primary" for="teacher.id">{{teacher.nombre}}</label> -->

        <div class="row">
            <div class="col-12" style="width: 2500px;">
                <div class="container">
                <table class="table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align:center; padding-top:25px; padding-bottom:15px; border:solid; background-color:  #006666; color:#ffffff; " v-for="day in Days" :key="day.id">
                                {{ day.Dia }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td v-for="day in Days" :key="day.id" >
                              <div v-for="clase in day.Clases"  :key="clase.id">
                                <div v-if="clase.status == 1"  >
                                  <button style="display: block; height:50px;"
                                      type="button"
                                      class="custom-btn btn-13"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 3"  >
                                  <button style="display: block; height:50px;"
                                      type="button"
                                      class="custom-btn btn-6"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                                 <div v-else-if="clase.status == 4"  >
                                  <button style="display: block; height:50px;"
                                      type="button"
                                      class="custom-btn btn-7"
                                      @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)"
                                      >
                                      {{ clase.Clase }}
                                      {{ clase.nombre }}
                                  </button>
                                </div>
                               
                                <div v-else >
                                  <button style="display: block; height:50px;"
                                      type="button"
                                      class="custom-btn btn-5"
                                     @click="show_modal(clase.nombre, clase.id_person, clase.clase_id)">
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
                                  <input class="form-control" type="text">

                                </div> 

                                <div class="container" v-if="cambioClase"> 
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

                                         <button
                                        type="button"
                                        class="btn btn-success"
                                        @click.prevent="realizarCambio($event)"

                                    >
                                       Guardar Cambio
                                    </button>

                                </div>

                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        @click="showModal = false, cambioClase=false"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                    >
                                        Aceptar
                                    </button>
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
            teacher_id: "",
            Days: [],
            Teachers: [],
            showModal: false,
            person_name: "",
            cambioClase:false,
            noPresente:false,
            person:{
              $first_id:"",
              teacher_id: "",
              day_id: "",
              clase_id: "",
              person_id:"",
            },
            teachers: [],
            days: [],
            clases: []

        };
    },

    mounted() {
        this.mostrarDatos();
    },
    methods: {
        async mostrarDatos() {
            await this.axios
                .get(`/api/listado`)
                .then(response => {
                    const { Days, Teachers } = response.data;
                    this.Days = Days;
                    this.Teachers = Teachers;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async cargar_clases(event) {
            console.log(event.target.value);
            var id = event.target.value;
            await this.axios
                .get(`/api/listado_teacher/${event.target.value}`)
                .then(response => {
                    const { Days } = response.data;
                    this.Days = Days;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        show_modal(nombre,id_person, id) {
          this.person_name=nombre
          console.log(id_person)
          console.log(id)
          this.person.first_id = id;
            this.person.person_id = id_person;
            this.showModal = true;
        },

        CambioClase(event){
            this.noPresente=false;

                event.preventDefault()
            this.cambioClase=true,
            console.log(this.showModal)
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
          })
            .catch(error => {
                console.log(error);
            });
        }
    }
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

/* 1 */
.btn-1 {
  transition: all 0.3s ease;
}
.btn-1:hover {
   box-shadow:
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}

/* 2 */
/* .btn-2 {
  
} */
.btn-2:after {
  position: absolute;
  content: "";
  top: 5px;
  left: 6px;
  width: 90%;
  height: 70%;
  border: 1px solid #000;
  opacity: 0;
  transition: all 0.3s ease;
}
.btn-2:hover:after {
  opacity: 1;
}


/* 3 */
.btn-3 {
  line-height: 39px;
  padding: 0;
}
.btn-3:hover{
  background: transparent;
  color: #000;
}
.btn-3 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-3:before,
.btn-3:after {
  position: absolute;
  content: "";
  left: 0;
  top: 0;
  background: #000;
  transition: all 0.3s ease;
}
.btn-3:before {
  height: 0%;
  width: 2px;
}
.btn-3:after {
  width: 0%;
  height: 2px;
}
.btn-3:hover:before {
  height: 100%;
}
.btn-3:hover:after {
  width: 100%;
}
.btn-3 span:before,
.btn-3 span:after {
  position: absolute;
  content: "";
  right: 0;
  bottom: 0;
  background: #000;
  transition: all 0.3s ease;
}
.btn-3 span:before {
  width: 2px;
  height: 0%;
}
.btn-3 span:after {
  width: 0%;
  height: 2px;
}
.btn-3 span:hover:before {
  height: 100%;
}
.btn-3 span:hover:after {
  width: 100%;
}

/* 4 */
.btn-4 {
  position: relative;
  color: #000;
  z-index: 2;
  line-height: 40px;
  padding: 0;
}
.btn-4:hover{
  border: none;
}
.btn-4:before,
.btn-4:after {
  position: absolute;
  content: "";
  width: 0%;
  height: 0%;
  border: 2px solid;
  z-index: -1;
  transition: all 0.3s ease;
}
.btn-4:before {
  top: 0;
   left: 0;
   border-bottom-color: transparent;
   border-right-color: transparent;
   border-top-color: #000;
   border-left-color: #000;
}
.btn-4:after{
   bottom: 0;
   right: 0;
   border-top-color: transparent;
   border-left-color: transparent;
   border-bottom-color: #000;
   border-right-color: #000;
}
.btn-4:hover:before,
.btn-4:hover:after {
  border-color: #000;
  height: 100%;
  width: 100%;
}



/* 5 */
.btn-5 {
      background: rgb(7, 102, 39);
  color: #fff;
  line-height: 42px;
  
  border: none;
   margin: 3px;
  padding: 3px;
}
.btn-5:hover {
  background: rgb(116, 180, 145);
  color: rgb(255, 255, 255);
   box-shrgb(218, 218, 218):
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
}
.btn-5:before,
.btn-5:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
       background: rgb(7, 102, 39);

  transition:400ms ease all;
}
.btn-5:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
.btn-5:hover:before,
.btn-5:hover:after{
  width:100%;
  transition:800ms ease all;
}


/* 6 */
.btn-6 {
   background: rgb(201, 70, 0);
  color: #fff;
  line-height: 42px;
  padding: 0;
  border: none;
}
.btn-6 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-6:before,
.btn-6:after {
  position: absolute;
  content: "";
  height: 0%;
  width: 2px;
  background: #000;
}
.btn-6:before {
  right: 0;
  top: 0;
  transition: all 500ms ease;
}
.btn-6:after {
  left: 0;
  bottom: 0;
  transition: all 500ms ease;
}
.btn-6:hover{
  color: #000;
  background: transparent;
}
.btn-6:hover:before {
  transition: all 500ms ease;
  height: 100%;
}
.btn-6:hover:after {
  transition: all 500ms ease;
  height: 100%;
}
.btn-6 span:before,
.btn-6 span:after {
  position: absolute;
  content: "";
  background: #000;
}
.btn-6 span:before {
  left: 0;
  top: 0;
  width: 0%;
  height: 2px;
  transition: all 500ms ease;
}
.btn-6 span:after {
  right: 0;
  bottom: 0;
  width: 0%;
  height: 2px;
  transition: all 500ms ease;
}
.btn-6 span:hover:before {
  width: 100%;
}
.btn-6 span:hover:after {
  width: 100%;
}

/* 7 */
.btn-7 {
   background: rgb(191, 92, 0);
  color: #fff;
  line-height: 42px;
  padding: 0;
  border: none;
  z-index: 1;
   -webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;
}
.btn-7:hover {
  background: rgba(5, 119, 172, 0.911);
  color: rgb(223, 219, 219);
}
.btn-7:before,
.btn-7:after {
  position: absolute;
  content: "";
  left: 0;
  width: 100%;
  height: 50%;
  right: 0;
  z-index: -1;
  background: rgb(95, 12, 72);
  transition: all 0.3s ease;
}
.btn-7:before {
  top: 0;
}
.btn-7:after {
  bottom: 0;
}
.btn-7:hover:before,
.btn-7:hover:after {
  height: 0;
  background-color: rgb(4, 3, 58);
}




/* 8 */
.btn-8 {
   line-height: 40px;
  padding: 0;
  background: transparent;
  position: relative;
  z-index: 2;
  color: #fff;
  -webkit-perspective: 300px;
  perspective: 300px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
}
.btn-8:hover{
  color: #000;
}
.btn-8:after {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  z-index: -1;
  -webkit-transform-origin: center bottom;
  transform-origin: center bottom;
  -webkit-transform: rotateX(0);
  transform: rotateX(0);
  transition: all 0.3s ease;
}
.btn-8:hover:after {
  -webkit-transform: rotateX(-180deg);
  transform: rotateX(-180deg);
}
  

/* 9 */
.btn-9 {
  z-index: 2;
  transition: all 0.3s ease;
  overflow: hidden;
}
.btn-9:after {
  position: absolute;
  content: " ";
  z-index: -1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: all 0.3s ease;
}
.btn-9:hover {
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
  color: #fff;
}
.btn-9:hover:after {
  -webkit-transform: scale(2) rotate(180deg);
  transform: scale(2) rotate(180deg);
  background: #000;
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
}

/* 10 */
.btn-10 {
  transition: all 0.3s ease;
  overflow: hidden;
}
.btn-10:after {
  position: absolute;
  content: " ";
  top: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  transition: all 0.3s ease;
  -webkit-transform: scale(.1);
  transform: scale(.1);
}
.btn-10:hover {
  color: #fff;
}
.btn-10:hover:after {
  background: #000;
  -webkit-transform: scale(1);
  transform: scale(1);
}

/* 11 */
.btn-11 {
  overflow: hidden;
  transition: all 0.3s ease;
}
.btn-11:hover {
   background: #000;
  color: #fff;
}
.btn-11:before {
    position: absolute;
    content: '';
    display: inline-block;
    top: -180px;
    left: 0;
    width: 30px;
    height: 100%;
    background-color: #fff;
    animation: shiny-btn1 3s ease-in-out infinite;
}
.btn-11:active{
  box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
}


@-webkit-keyframes shiny-btn1 {
    0% { -webkit-transform: scale(0) rotate(45deg); opacity: 0; }
    80% { -webkit-transform: scale(0) rotate(45deg); opacity: 0.5; }
    81% { -webkit-transform: scale(4) rotate(45deg); opacity: 1; }
    100% { -webkit-transform: scale(50) rotate(45deg); opacity: 0; }
}


/* 12 */
.btn-12{
  position: relative;
  right: 20px;
  bottom: 20px;
  border:none;
  width: 130px;
  height: 40px;
  line-height: 40px;
  -webkit-perspective: 230px;
  perspective: 230px;
}
.btn-12 span {
  display: block;
  position: absolute;
  width: 130px;
  height: 40px;
  border: 2px solid #000;
  margin:0;
  text-align: center;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all .3s;
  transition: all .3s;
}
.btn-12 span:nth-child(1) {
  box-shadow:
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
  -webkit-transform: rotateX(90deg);
  -moz-transform: rotateX(90deg);
  transform: rotateX(90deg);
  -webkit-transform-origin: 50% 50% -20px;
  -moz-transform-origin: 50% 50% -20px;
  transform-origin: 50% 50% -20px;
}
.btn-12 span:nth-child(2) {
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  transform: rotateX(0deg);
  -webkit-transform-origin: 50% 50% -20px;
  -moz-transform-origin: 50% 50% -20px;
  transform-origin: 50% 50% -20px;
}
.btn-12:hover span:nth-child(1) {
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  transform: rotateX(0deg);
}
.btn-12:hover span:nth-child(2) {
  background: #e0e5ec;
  color: #e0e5ec;
  -webkit-transform: rotateX(-90deg);
  -moz-transform: rotateX(-90deg);
  transform: rotateX(-90deg);
}


/* 13 */
.btn-13 {
   background: rgb(20, 61, 138);
  color: #fff;
  z-index: 1;
  margin: 3px;
  padding: 3px;


}
.btn-13:after {
  position: absolute;
  content: "";
  width: 100%;
  height: 0;
  bottom: 0;
  left: 0;
  z-index: -1;
   background: #2e77ff;
  transition: all 0.3s ease;
}
.btn-13:hover {
  color: rgb(46, 46, 46);
}
.btn-13:hover:after {
  top: 0;
  height: 100%;
}
.btn-13:active {
  top: 2px;
}


/* 14 */
.btn-14 {
   background: #000;
  color: #fff;
  z-index: 1;
}
.btn-14:after {
  position: absolute;
  content: "";
  width: 100%;
  height: 0;
  top: 0;
  left: 0;
  z-index: -1;
  background: #e0e5ec;
  transition: all 0.3s ease;
}
.btn-14:hover {
  color: #000;
}
.btn-14:hover:after {
  top: auto;
  bottom: 0;
  height: 100%;
}
.btn-14:active {
  top: 2px;
}

/* 15 */
.btn-15 {
   background: #000;
  color: #fff;
  z-index: 1;
}
.btn-15:after {
  position: absolute;
  content: "";
  width: 0;
  height: 100%;
  top: 0;
  right: 0;
  z-index: -1;
   background: #e0e5ec;
  transition: all 0.3s ease;
}
.btn-15:hover {
  color: #000;
}
.btn-15:hover:after {
  left: 0;
  width: 100%;
}
.btn-15:active {
  top: 2px;
}


/* 16 */
.btn-16 {
   background: #000;
  color: #fff;
  z-index: 1;
}
.btn-16:after {
  position: absolute;
  content: "";
  width: 0;
  height: 100%;
  top: 0;
  left: 0;
  direction: rtl;
  z-index: -1;
  background: #e0e5ec;
  transition: all 0.3s ease;
}
.btn-16:hover {
  color: #000;
}
.btn-16:hover:after {
  left: auto;
  right: 0;
  width: 100%;
}
.btn-16:active {
  top: 2px;
}
</style>
