<template>
    <div>
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
                   <li  class="nav-item">
                       <a href="" id="HoraActual" class="nav-link">Hora: {{timestamp}} </a>
                    </li>   
                           
                </ul>
               
                </div>
            </div>
        </nav>
        <div style="margin:0px; pading:0px;">
            <router-view></router-view>
        </div>
    </div>
</template>
 <style scoped>
 
ul>li{
    font-size: 24px;
    padding: 5px;
    font-weight: bolder;
}

 </style>
 
<script>
  

    export default {
        data(){
        return{
                timestamp: "",
            }
        },
     
      
        mounted() {
            

        },
        created(){
                setInterval(this.getNow, 1000);

        },
    
        methods: {

            getNow: function() {
                        const today = new Date();
                        const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                        const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                       
                        this.timestamp = time;
                    }

        }

    }
</script>