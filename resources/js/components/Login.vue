<template>
<div class="cont">

   <div class="login-page">
      <transition name="fade">
         <div v-if="!registerActive" class="wallpaper-login"></div>
      </transition>
      <div class="wallpaper-register"></div>

      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
               <div v-if="!registerActive" class="card login" v-bind:class="{ error: emptyFields }">
                  <h1>Sign In</h1>
                  <form class="form-group">
                     <input v-model="emailLogin" type="email" class="form-control" placeholder="Email" required>
                     <input v-model="passwordLogin" type="password" class="form-control" placeholder="Password" required>
                     <input type="submit" class="btn btn-primary" @click.prevent="doLogin">
                     
                     
                  </form>
               </div>


            </div>
         </div>

      </div>
   </div>

</div>
</template>

<script>
export default {

   data() {
       return{
          
      registerActive: false,
      emailLogin: "",
      passwordLogin: "",
      emailReg: "",
      passwordReg: "",
      confirmReg: "",
      emptyFields: false
       }
 
   },
   
   methods: {
        async doLogin() {
            var email =this.emailLogin
            var pass =this.passwordLogin
            await this.axios
                .post(`/api/login/${email}/${pass}`)
                .then(response => {
                    const { respuesta } = response.data;
                    console.log(respuesta)
                    if(respuesta == 1){
                        this.$router.push({ name: "app" })
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
   }
}
</script>

<style scoped>
p {
   line-height: 1rem;
}
.cont{
/* background-image:url('https://cdn.pixabay.com/photo/2015/11/02/18/32/water-1018808_960_720.jpg') ;      */
background-color: rgb(98, 0, 255);

}

.card {
   padding: 20px;
}

.form-group {
   input {
      margin-bottom: 20px;
   }
}

.login-page {
   align-items: center;
   display: flex;
   height: 100vh;

   .wallpaper-login {
      background: url(https://images.pexels.com/photos/32237/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260)
         no-repeat center center;
      background-size: cover;
      height: 100%;
      position: absolute;
      width: 100%;
   }
   
   .fade-enter-active,
   .fade-leave-active {
  transition: opacity .5s;
}
   .fade-enter,
   .fade-leave-to {
      opacity: 0;
   }
   
   .wallpaper-register {
      : url(https://images.pexels.com/photos/533671/pexels-photo-533671.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260)
         no-repeat center center;
      background-size: cover;
      height: 100%;
      position: absolute;
      width: 100%;
      z-index: -1;
   }

   h1 {
      margin-bottom: 1.5rem;
   }
}

.error {
   animation-name: errorShake;
   animation-duration: 0.3s;
}

@keyframes errorShake {
   0% {
      transform: translateX(-25px);
   }
   25% {
      transform: translateX(25px);
   }
   50% {
      transform: translateX(-25px);
   }
   75% {
      transform: translateX(25px);
   }
   100% {
      transform: translateX(0);
   }
}

</style>