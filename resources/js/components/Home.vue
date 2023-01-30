<template>
    <div class="container">
        <br><br>
        



        <br>
        <h2 align="center">Reportes de clases asignadas e impartidas</h2>
        <br><br>

        <div>
            <span style="font-size:23px ">Quincenal -</span>     <button @click="generarReporte" type="button" class="btn btn-success">Generar Reporte</button>
            <span style="font-size:23px ">Asistencias Mensual -</span>     <router-link to="/AsistenciasT" target="_blank" type="button" class="btn btn-success">Ver asistencias</router-link>
            <span style="font-size:23px ">Imprimir Credenciales -</span>     <router-link to="/printAll" target="_blank" type="button" class="btn btn-success">Imprimir Credenciales</router-link>


            <hr>
            <table class="table">
            <thead class="thead-dark">
             
                <th>Nombre Profesor</th>
                <th>Clases Asignadas</th>
                <th>Clases Grupales</th>
                <th>Clases Impartidas</th>
              
            </thead>
            <tbody>
                <tr v-for="valor in result1" :key="valor.index">
                
                <td>{{valor[0].name}}</td>
                <td>{{ Math.round(valor[0].number/10) }} </td>
                <td>{{0}} </td>
                <td>{{valor[1].total_classes}} </td>
               
                </tr>
               

            </tbody>
        </table>
        </div>
        <br><br>


        
    </div>
</template>



<script>


export default {
  data(){
      return{
        result1:[],
        teacher:[],
        alumno:[],


      }
  },
    mounted(){
        this.mostrarDatos()

    },
    created(){
        setInterval(this.takeMinutes, 20000);

    },

  methods :{

    generarReporte(){
        var currentLocation = window.location.host;
        if(confirm('Está seguro de generar el reporte quincenal? Esto generara el corte de los pagos.')){
        const win = window.open(`QuincenalPersons`, '_blank');
        const win2 = window.open(`QuincenalPersons`, '_blank');
            // window.open(`credencial/${id}`)


        }
    },

      takeMinutes: function(){
             this.axios
                .get(`/api/clasesMonth`)
                .then(response => {
                    const { Clases } = response.data;
                    this.result1=Clases
                    console.log('entrando')
                })
                .catch(error => {
                    console.log(error);
                });

            
       },

        async mostrarDatos() {
            await this.axios
                .get(`/api/clasesMonth`)
                .then(response => {
                    const { Clases } = response.data;
                    this.result1=Clases
                })
                .catch(error => {
                    console.log(error);
                });
        },
     

  }
}
</script>
