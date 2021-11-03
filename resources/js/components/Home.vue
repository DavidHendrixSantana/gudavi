<template>
    <div class="container">
        <br>
        <h2 align="center">Reportes</h2>
        <br><br>

        <div>
            <span style="font-size:23px ">Quincenal                   -</span>  <button type="button" class="btn btn-success">Generar Corte</button>

            <hr>
            <table class="table">
            <thead class="thead-dark">
             
                <th>Nombre Profesor</th>
                <th>Clases Asignadas</th>
              
            </thead>
            <tbody>
                <tr v-for="valor in result1" :key="valor.index">
                
                <td>{{valor[0].name}}</td>
                <td>{{valor[0].number}} </td>
               
                </tr>
               

            </tbody>
        </table>
        </div>
        <br><br>

        <div>
             <span style="font-size:23px ">Semanal                   -</span>  <button type="button" class="btn btn-success">Generar Corte</button>

            <hr>
                <table class="table">
                <thead class="thead-dark">
                
                    <th>Nombre Profesor</th>
                    <th>Clases Asignadas</th>
                    <th>Clases Impartidas</th>
                
                </thead>
                <tbody>
                    <tr v-for="valor in result1" :key="valor.index">
                    
                    <td>{{valor[0].name}}</td>
                    <td>{{valor[0].number}} </td>
                    <td>0 </td>
                
                    </tr>
                

                </tbody>
                </table>
        </div>

        <br><br>
        <div>
                         <span style="font-size:23px ">Diario                   -</span>  <button type="button" class="btn btn-success">Generar Corte</button>

            <hr>
                <table class="table">
                <thead class="thead-dark">
                
                    <th>Nombre Profesor</th>
                    <th>Clases Asignadas</th>
                    <th>Clases Impartidas</th>
                
                </thead>
                <tbody>
                    <tr v-for="valor in result1" :key="valor.index">
                    
                    <td>5</td>
                    <td>3</td>
                    <td>0 </td>
                
                    </tr>
                

                </tbody>
                </table>
        </div>
        
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
