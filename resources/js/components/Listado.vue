<template>
<main>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-for="teacher in Teachers" :key="teacher.id">
        <input type="radio" class="btn-check" name="btnradio" v-model="teacher_id" :id="teacher.id" autocomplete="off">
        <label class="btn btn-outline-primary" :for="teacher.id">{{teacher.nombre}}</label>

        </div>
    <div>
                <table class="table">
        <thead>
            <tr >
            <th scope="col" v-for="day in Days"  :key="day.id" >{{day.Dia}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="clase in Clases"  :key="clase.id">
            <td>{{clase.Clase}}</td>
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
            Clases :[],
            Day_clase :[],
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
                        Clases,
                        Day_clase
                    } = response.data;
                    this.Days = Days;
                    this.Teachers = Teachers;
                    this.Clases = Clases;
                    this.Day_clase = Day_clase;
                })
                .catch(error => {
                    console.log(error);
                });

        },

    }
};
</script>
