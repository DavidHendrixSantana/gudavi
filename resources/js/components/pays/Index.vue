<template>
<div class="container">
<br>
    <div class="row">
      

        <div class="row">
            <div class="col-lg-12"> <h2> Reportes por fechas</h2> </div>
            <div class="row">
                <div class="col-lg-2"> 
                    <h4>Tipo de pagos :</h4>  
                
                </div>
                <div class="col-lg-2"> 
                    <select v-model="tipo_pago" name="" id="">
                        <option value="Ambos">Ambos</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                    </select> 
                </div>
            </div>
            <div class="col-lg-4">
            <label for=""> <h4> Fecha Inicio </h4> </label>
            <input v-model="fecha_inicio" type="date" name="" id="">
            </div>

            <div class="col-lg-4">
            <label for=""> <h4> Fecha Final </h4> </label>
            <input v-model="fecha_final" type="date" name="" id="">
            </div>

            <div class="col-lg-4">
                 <button to="/QuincenalPersons" @click="reporteFechas" type="button" class="btn btn-success">Generar Reporte</button>
            </div>

            <br><br>

        </div>

       

        <div class="col-12">
            <div class="table-responsive">
                <table id="pay_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Folio</th>
                            <th>Forma Pago</th>
                            <th>Tarjeta</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pay in pays" :key="pay.id">
                            <td > <span v-if="pay.forma_pago === 'Tarjeta' "> 000{{folio_tarjeta}} </span> <span v-if="pay.forma_pago === 'Efectivo'"> 000{{folio_efectivo}} </span></td>
                            <td>
                                {{ pay.forma_pago }}
                         
                            </td>
                            <td> <div  v-if="pay.forma_pago === 'Tarjeta'"> {{ pay.tipo_tarjeta }}</div> </td>

                            <td>
                                {{ pay.cantidad }}
                              
                            </td>
                              <td>
                                {{ pay.created_at }}
                              
                            </td>

                            <td>
                               
                                
                                   <button style="display: block; height:50px;"
                                    class="btn btn-danger"
                                    type="button"
                                    @click="show_modal($event)"
                                    :value="pay.id"
                                >
                                   Reembolsar
                                </button>
                           
                            </td>
                        </tr>
                    </tbody>
                </table>

                
            </div>
        </div>
        <div class="row">
                    <div class="col-lg-12">
                    
                    <span>Reporte Historico</span> <router-link to="/QuincenalPersons" target="_blank" type="button" class="btn btn-success">Generar Reporte</router-link>
                    
                    </div>
                </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "pays",
    data() {
        return {
            pays: [],
            folio_efectivo: 0,
            folio_tarjeta: 0,
            tipo_pago: '',
            fecha_inicio: '',
            fecha_final: '',
        };
    },
    mounted() {
        this.mostrarPays();
    
    },
    methods: {
        mostrarPays() {
            this.axios
                .get("/api/pay")
                .then(response => {
                    this.pays = response.data;
                          $(document).ready( function () {
                    $('#pay_table').DataTable();
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        },
      async  reporteFechas(){
          console.log('peticion')
          const tipo_pago =this.tipo_pago
          const fecha_inicio =this.fecha_inicio
          const fecha_final =this.fecha_final
            await this.axios
                .get(`/person/ShowClasses/${tipo_pago}/${fecha_inicio}/${fecha_final}`)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error);
                });
                    
          
        
        },

        generarReporte(){
            this.axios.get('Quincenal')
            .then();
        },
    
    }
};
</script>
