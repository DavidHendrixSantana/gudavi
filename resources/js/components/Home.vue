<template>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-6">
                <h3>Pase de Lista profesores</h3>
                <table class="table">
                    <thead>
                        <th>Pase de lista</th>
                        <th>Hora de llegada</th>
                    
                    </thead>
                    <tbody>
                        <tr v-for="value in teacher" :key="value.index">
                            <td>
                            {{value.nombre}}
                            </td>
                            <td>
                                {{ value.created_at.substr(11)}}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h3>Pase de Lista Alumnos</h3>

                <table class="table">
                    <thead>
                        <th>Pase de lista</th>
                        <th>Hora de llegada</th>
                    
                    </thead>
                    <tbody>
                  <tr v-for="value in alumno" :key="value.index">
                            <td>
                            {{value.nombre}}
                            </td>
                            <td>
                                {{ value.created_at.substr(11)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



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
        this.verifyLista()

    },
    created(){
        setInterval(this.takeMinutes, 20000);

    },

  methods :{

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

                this.axios
                .get(`/api/verificarListas`)
                .then(response => {
                    const { teacher,alumno } = response.data;
                    this.teacher=teacher
                    this.alumno=alumno
                    console.log(response)

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
        async verifyLista() {
            await this.axios
                .get(`/api/verificarListas`)
                .then(response => {
                    const { teacher,alumno } = response.data;
                    this.teacher=teacher
                    this.alumno=alumno

                })
                .catch(error => {
                    console.log(error);
                });
        },
  }
}
</script>
