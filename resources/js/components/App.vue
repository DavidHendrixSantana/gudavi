<template>
<div>


    <div v-if="navbar">
            <nav style="background-color: #006699 "  class="navbar navbar-expand-lg navbar-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <!-- llamamos al logo de Vue -->
                        <img src="/images/logo.png" alt="" width="130" height="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/" class="nav-link" aria-current="page">Inicio</router-link>
                        </li>
                        <li   class="nav-item">
                            <router-link exact-active-class="active" to="/listado" class="nav-link">Seguimiento</router-link>
                        </li>   
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/asistencias" class="nav-link">Asistencias</router-link>
                        </li>   
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/persons" class="nav-link">Estudiantes</router-link>
                        </li>   
                        <!-- <li class="nav-item">
                            <router-link exact-active-class="active" to="/schedules" class="nav-link">Horarios</router-link>
                        </li>    -->
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/teachers" class="nav-link">Profesores</router-link>
                        </li>  
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/pays" class="nav-link">Pagos</router-link>
                        </li>    
                        
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/pendientes" class="nav-link">Clases Pendientes</router-link>
                        </li>  
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/bajas" class="nav-link">Estudiantes Inactivos</router-link>
                        </li>  
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/logs" class="nav-link">Actividades</router-link>
                        </li>  

                    <li  class="nav-item">
                        <a  style="padding-left:400px;" href="" id="HoraActual" class="nav-link">Hora: {{timestamp}} </a>
                        </li>   

                 
                            
                    </ul>
                
                    </div>
                </div>
                <audio id="audio" controls>
                <source type="audio/mp3" src="images/Timbre.mp3">
                </audio>

            </nav>
            <div style="margin:0px; pading:0px;">
                <router-view></router-view>
                
            </div>

    </div>

     <div style="height:100%; background-image: url(https://cdn.pixabay.com/photo/2015/11/02/18/32/water-1018808_960_720.jpg);"   v-if="login">

                <section id="login" v-bind:class="isShake">
                    <img style=" margin-left:30%; border-radius:20px; margin-top:10%" src="/images/logo.png" width="40%" height="40%" alt="">

                    <form>
                    <h2>Inicio de sesión</h2>
                    <div class="info" v-bind:class="good">
                    </div>
                    <label for="">USUARIO DE INICIO:</label>
                    <input type="text" v-model="emailLogin" placeholder="Username" />
                    <label for="">CONTRASEÑA DE INICIO:</label>
                    <input type="password" v-model="passwordLogin" placeholder="Password" />
                    <button @click.prevent="doLogin">Iniciar Sesión</button>
                    </form>
                </section>

        </div>
</div>
</template>

<script>
export default {

   data(){
       return{
		alert: {
			message: "hello world"
		},
		login: {
			login: "",
			password: ""
		},
		shake: false,
		good: "",
		fake: {
			login: "vincent",
			password: "admin"
		},
          login:false,
          navbar:true,
      registerActive: false,
      emailLogin: "",
      passwordLogin: "",
      user:[],
      showPays:false,
      barCodeReader:true,
      showTeachersP:false,
      hrNow:"",
      tiempo:"",
       timestamp: "",
       firtsHour: "",
        }
	},
    created(){

                setInterval(this.getNow, 1000);
                setInterval(this.takeMinutes, 60000);
                this.firstHr();
                this.verifyDay();
               
  
            	

        },
        mounted(){
            var currentLocation = window.location.host;
            var barcode = '';
            var interval;
            // if(this.barCodeReader){
            // document.addEventListener('keydown', function(evt) {
            //     if (interval)
            //         clearInterval(interval);
            //     if (evt.code == 'Enter') {
            //         this.barCodeReader == false

            //         if (barcode)
            //         paseLista(barcode)
            //         barcode = '';
                    
            //         return;
            //     }
            //     if (evt.key != 'Shift')
            //         barcode += evt.key;
            //     interval = setInterval(() => barcode = '', 20);
            // });
            // }


          async  function  paseLista(matricula) {

            await axios
                .get(`/paseListaT/${matricula}`)
                .then(response => {
                    Swal.fire({
                        title: 'Pase de lista exitoso',
                        text: 'Se ha realizado el pase de lista de manera exitosa',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                        })
                    this.barCodeReader == true
                    
                })
                .catch(error => {
                  
                    Swal.fire({
                        title: 'No se encontraron coindicencias',
                        text: 'Verifique que el alumno y el día sean correctos',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                        })
                });
             
                    this.pasarLista = false

       
        }

        },
    computed: {
		isShake: function(){
			// console.log(this.shake);
			if(this.shake == true){
				return 'shake'
			}
			return 'none'
		} 
	},
   
   methods: {


    
       takeMinutes: function(){
           this.pasarLista()
       },
       alarma(){
           var audio = document.getElementById("audio");

            audio.play();
       },

       async pasarLista(){

            var minutes = this.giveMinutes()
           var hour = this.giveHours()
           if(minutes == '30' || minutes == '00' ){

          this.alarma()

               var valorHora = `${hour}:${minutes}`
            await this.axios.get(`ListaClases/${valorHora}`).then(
                   response =>{
                    // console.log(response);
                   }
            ).catch( error =>{
                console.log(error)
            })
           }
       },

         


       async firstHr(){
              await this.axios.get(`getFirstHour`)
           .then(response => {
               const {firstHour} = response.data;
               this.firtsHour = firstHour
            //    console.log(firstHour)

           }).catch(error => {
                    console.log(error);
                });              
       },

        async verifyDay(){
        const today = new Date();
           var hoy = today.getDate();
      

              await this.axios.get(`verifyDay/${hoy}`)
           .then(response => {
           
                 
           }).catch(error => {
                    
                });              

     
       },

       giveTime(){
                        const hr = formatoHora(today.getHours())  
                        const min = formatoHora(today.getMinutes()) 
                        this.hrNow = `${hr}:00`
                        this.tiempo= `${hr}:${min}`    
                        function formatoHora(hora){
                            if(hora<10)
                            hora= '0'+ hora;
                            return hora;
                        }
       },

       giveMinutes(){
        const today = new Date();
           var minutes = formatoHora(today.getMinutes()) 
               function formatoHora(hora){
                            if(hora<10)
                            hora= '0'+ hora;
                            return hora;
                        }
           return minutes
       },

            giveHours(){
        const today = new Date();
           var minutes = formatoHora(today.getHours()) 

               function formatoHora(hora){
                            if(hora<10)
                            hora= '0'+ hora;
                            return hora;
                        }
           return minutes
       },

        async doLogin() {
            var email =this.emailLogin
            var pass =this.passwordLogin
            await this.axios
                .get(`/api/login/${email}/${pass}`)
                .then(response => {
                    
                    const { respuesta } = response.data;
                    const { user } = response.data;
                    this.user = user
                    if(respuesta == 1){
                        this.login=false,
                        this.navbar=true
                        this.verificarRol()
                    }else if(respuesta == 0){
                       $.notify("CONTRASEÑA INCORRECTA", "error");
                    }else if(respuesta == 3){
                     $.notify(" USUARIO INCORRECTO", "error");

                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },

           getNow: function() {
                        const today = new Date();
                        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                        const hr = formatoHora(today.getHours())  
                        const min = formatoHora(today.getMinutes()) 
                        const seg =  formatoHora(today.getSeconds())
                        const time = `${hr}:${min}:${seg}`

                        function formatoHora(hora){
                            if(hora<10)
                            hora= '0'+ hora;
                            return hora;
                        }
                        this.timestamp = time;
                    },
            verificarRol(){
                if(this.user.rol === 1){
                    this.showPays=true
                this.showTeachersP=true
                }
                
            }
   }
}
</script>
<style scoped>
html, body{
	width:100%;
	height:100%;
	margin:0px;
	font-family: 'Work Sans', sans-serif;
}

body{
		
	  background-size: cover;
		display: flex;
		flex-direction:column;
		justify-content:center;
	  align-items:center;
		color: #fff;
}

section{
   margin-top:50px;
    margin-left:30% ;
	background-color: rgba(13, 83, 92, 0.72);
	width:40%;
	min-height:40%;
	display:flex;
	flex-direction:column;
    border-radius: 20px;
	/*margin-left:auto;
	margin-right:auto;*/
}
form{
	display:flex;
	flex-direction:column;
	padding: 15px; 
}

label{
    	font-family: 'Archivo Black', sans-serif;
	color:#e0dada;
	
    font-size: 18px;
}
h2{
	font-family: 'Archivo Black', sans-serif;
	color:#e0dada;
	margin-left:auto;
	margin-right:auto;
    font-size: 36px;
}

.info{
	width:100%;
	padding: 1rem 5px;
	text-align:center;
	min-height:45px;
	display:flex;
	flex-direction:column;
	justify-content:center;
	align-items:center;
}

.info.error{
	border:1px solid #a90e0;
	background-color: #ff3c41;
	color:#a90e0;
}
.info p{
	margin:auto;
	padding:5px;
}
.info.good{
	border:1px solid #416d50;
	background-color: #47cf73;
	color:#416d50;
}

input{
	height:35px;
	padding: 5px 5px;
	margin: 10px 0px;
	background-color:#e0dada;
	border:none;
}
button{
	height:40px;
	padding: 5px 5px;
	margin: 10px 0px;
	font-weight:bold;
	background-color:#be5256;
	border:none;
	color:#e0dada;
	cursor:pointer;
	font-size:16px;
}
button:hover{
	background-color:#711f1b;
}

#content {
  position: absolute; 
  left: 0; 
  right: 0; 
  margin-left: auto; 
  margin-right: auto; 
  width: 100%; /* Need a specific value to work */
}

@-webkit-keyframes shake{
	from, to{
		-webkit-transform: translate3d(0, 0, 0);
		transform:translate3d(0,0,0);
	}
	10%,30%,50%,70%,90%{
		-webkit-transform: translate3d(-10px, 0, 0);
		transform:translate3d(-10px,0,0);
	}
	20%,40%,60%,80%{
		-webkit-transform: translate3d(10px, 0, 0);
		transform:translate(10px,0,0);
	}
}

.shake{
	animation-name: shake;
	animation-duration:1s;
	/*animation-fill-mode: both;*/
}

@media screen and (max-width: 780px) {
	section{
		width:90%;
	}
}
</style>