<template>
  <div class="container">
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
                                {{ value.updated_at.substr(11)}}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h3>Pase de Lista Alumnos</h3>

                <table v-if="alumno" class="table">
                    <thead>
                        <th>Pase de lista</th>
                        <th>Hora de llegada</th>
                    
                    </thead>
                    <tbody>
                  <tr  v-for="value in alumno" :key="value.index">
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
  </div>
</template>

<script>
export default {
  data(){
      return{
        teacher:[],
        alumno:[],
      }
  },
      mounted(){
        this.verifyLista()

    },
        created(){
        setInterval(this.takeMinutes, 20000);

    },
  methods: {
      takeMinutes: function(){

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
            async verifyLista() {
                   

            await this.axios
                .get(`/api/verificarListas`)
                .then(response => {
                    const { teacher,alumno } = response.data;
                    this.teacher=teacher
                    this.alumno=alumno
                    teacher.forEach(element => {
                        console.log(element)
                    });
                    

                })
                .catch(error => {
                    console.log(error);
                });
        },
  }
}
</script>

<style>

</style>