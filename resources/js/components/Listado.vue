<template>
<main>
    <div class="row" >
        <div class="col-4" v-for="teacher in Teachers" :key="teacher.id">
            <div class="row">
                <button type="button" v-on:click="cargar_clases($event)" :value="teacher.id" :id="teacher.id" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                {{teacher.nombre}}
                </button>
             </div>
        </div>
    </div>
   
        <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-for="teacher in Teachers" :key="teacher.id">
        <input type="radio" class="btn-check" name="btnradio"   v-on:click="cargar_clases($event)" v-model="teacher_id" :id="teacher.id" autocomplete="off">
        <label class="btn btn-outline-primary" for="teacher.id">{{teacher.nombre}}</label> -->

       
    <div>
                <table class="table">
        <thead>
            <tr >
            <th scope="col" v-for="day in Days"  :key="day.id" >{{day.Dia}}</th>
            </tr>
        </thead>
        <tbody>
        <tr>
             <td v-for="day in Days"  :key="day.id">
            <div  v-for="clase in day.Clases" :key="clase.id">
            <td>{{clase.Clase}}</td>
            </div>
            </td>
        </tr>
        </tbody>
        </table>
    </div>

</main>

</template>

<script>


export default {
     name: "Listado",
    data() {
        return{
            teacher_id:"",
            Days: [],
            Teachers :[],
       
        }
        
    },

      mounted() {
        this.mostrarDatos();
    },
    methods:{
        async mostrarDatos(){
             await this.axios
                .get(`/api/listado`)
                .then(response => {
                    const {
                        Days,
                        Teachers,
                 
                      
                    } = response.data;
                    this.Days = Days;
                    this.Teachers = Teachers;
        
                   
                })
                .catch(error => {
                    console.log(error);
                });

        },

     async   cargar_clases(event){
            console.log(event.target.value)
            var id = event.target.value
             await this.axios
                .get(`/api/listado_teacher/${event.target.value}`)
                .then(response => {
                    const {
                        Days,
                    } = response.data;
                    this.Days = Days;
                })
                .catch(error => {
                    console.log(error);
                });
        }

    }
};
</script>
