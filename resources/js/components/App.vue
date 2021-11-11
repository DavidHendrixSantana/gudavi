<template>
<div>
    <div v-if="navbar">
            <nav style="background-color: #006699 "  class="navbar navbar-expand-lg navbar-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <!-- llamamos al logo de Vue -->
                        <img src="/images/logo.jpg" alt="" width="130" height="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/" class="nav-link" aria-current="page">Inicio</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/listado" class="nav-link">Clases</router-link>
                        </li>   
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/persons" class="nav-link">Personas</router-link>
                        </li>   
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/schedules" class="nav-link">Horarios</router-link>
                        </li>   
                        <li class="nav-item">
                            <router-link exact-active-class="active" to="/teachers" class="nav-link">Profesores</router-link>
                        </li>  
                            <li class="nav-item">
                            <router-link exact-active-class="active" to="/pays" class="nav-link">Pagos</router-link>
                        </li>    
                        
                            <li class="nav-item">
                            <router-link exact-active-class="active" to="/pendientes" class="nav-link">Clases Pendientes</router-link>
                        </li>  

                    <li  class="nav-item">
                        <a  style="padding-left:400px;" href="" id="HoraActual" class="nav-link">Hora: {{timestamp}} </a>
                        </li>   
                            
                    </ul>
                
                    </div>
                </div>
            </nav>
            <div style="margin:0px; pading:0px;">
                <router-view></router-view>
            </div>

    </div>

     <div class="container" v-if="login">
         <img style=" margin-left:35% " src="/images/logo.jpg" width="30%" height="30%" alt="">

                <section id="login" v-bind:class="isShake">
                    <form>
                    <h2>Inicio de sesión</h2>
                    <div class="info" v-bind:class="good">
                    <p>Bienvenido</p>
                    </div>
                    <input type="text" v-model="emailLogin" placeholder="Username" />
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
          login:true,
          navbar:false,
      registerActive: false,
      emailLogin: "",
      passwordLogin: "",

       timestamp: "",
        }
	},
    created(){
                setInterval(this.getNow, 1000);

        },
    computed: {
		isShake: function(){
			console.log(this.shake);
			if(this.shake == true){
				return 'shake'
			}
			return 'none'
		}
	},
   
   methods: {
        async doLogin() {
            var email =this.emailLogin
            var pass =this.passwordLogin
            await this.axios
                .get(`/api/login/${email}/${pass}`)
                .then(response => {
                    const { respuesta } = response.data;
                    console.log(respuesta)
                    if(respuesta == 1){
                        this.login=false,
                        this.navbar=true
                    }else if(respuesta == 0){
                        alert('Contraseña incorrecta')
                    }else if(respuesta == 3){
                        alert('Usuario incorrecto')
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
                        const time = `${hr}:${min}:${seg}:`

                        const formatoHora = (hora) =>{
                            if(hora<10)
                            hora= '0'+ hora;
                            return hora;
                        }

                       

                        this.timestamp = time;
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
h2{
	font-family: 'Archivo Black', sans-serif;
	color:#e0dada;
	margin-left:auto;
	margin-right:auto;
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