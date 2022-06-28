<template>
    <div class="container">
        <br>
        <h2 align="center">Reportes de clases asignadas e impartidas</h2>
        <br><br>

        <div>
            <span style="font-size:23px ">Quincenal -</span>     <router-link to="/QuincenalPersons" target="_blank" type="button" class="btn btn-success">Generar Reporte</router-link>
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
                <td>{{valor[0].number/10}} </td>
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


      }
  },
    mounted(){
        this.mostrarDatos()

    },

  methods :{
        async mostrarDatos() {
            await this.axios
                .get(`/api/clasesMonth`)
                .then(response => {
                    const { Clases } = response.data;
                    this.result1=Clases
                    console.log(this.result1)
                })
                .catch(error => {
                    console.log(error);
                });
        },
  }
}
</script>
