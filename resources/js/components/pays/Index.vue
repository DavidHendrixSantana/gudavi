<template>
<div class="container">
<br>
    <div class="row">
      

        <div class="col-lg-12"> <h2> Reportes por fechas</h2> </div>

                <div class="col-lg-4"> 
                    <h4>Tipo de pagos :</h4>  
                
                </div>
                

            <div class="col-lg-4">
                <label for=""> <h4> Fecha Inicio </h4> </label>
                <input v-model="fecha_inicio" type="date" name="" id="">
            </div>

            <div class="col-lg-4">
                <label for=""> <h4> Fecha Final </h4> </label>
                <input v-model="fecha_final" type="date" name="" id="">
            </div>
            <div class="col-lg-6"> 
                        <select v-model="tipo_pago" name="" id="">
                            <option value="Ambos">Ambos</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select> 
            </div>
            <div class="col-lg-6">
                    <button to="/QuincenalPersons" @click="reporteFechas" type="button" class="btn btn-success">Generar Reporte</button>
            </div>

        </div>

            <br><br>

       

        <div class="col-12">
            <div class="table-responsive">
                <table id="pay_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Folio</th>
                            <th>Forma Pago</th>
                            <th>Tarjeta</th>
                            <th>Cantidad</th>
                            <th>Fecha del pago</th>
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
                                {{ pay.fecha_pago }}
                              
                            </td>

                            <td>
                               
                                
                                   <button style="display: block; height:50px;"
                                    class="btn btn-danger"
                                    type="button"
                                    @click="rembolso(pay.id)"
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

        <div v-if="showReembolso">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog"  role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Reembolsar pago
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        <span
                                            aria-hidden="true"
                                            @click="showReembolso = false"
                                            >&times;</span
                                        >
                                    </button>
                                </div>
                                <div class="container" > 
                             <div class="form-group">

                                    <label for="">Motivo:</label>
                                    <br>
                                   <input style="width:100%;" type="text" name="motivo" id="motivo" v-model="motivo" >
                                        
                                </div>
                                
                                    
                                         <button
                                        type="button"
                                        class="btn btn-success"
                                        @click="generarReemboloso()">
                                       Rembolsar Pago
                                    </button>

                                </div>

                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>

</template>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
    width: 500px;

}

.modal-body{
    width: 500px;

}
</style>

<script>
export default {
    name: "pays",
    data() {
        return {
            pays: [],
            folio_efectivo: 0,
            folio_tarjeta: 0,
            tipo_pago: 'Ambos',
            fecha_inicio: '',
            fecha_final: '',
            showReembolso: false,
            motivo: ''
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
                    $('#pay_table').DataTable( {
                                "language": {
                                "paginate": {
                                "next": "Siguiente",
                                "previous": "Anterior"
                                }
                            }
                            }
                    );
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        },
      async  reporteFechas(){
          console.log('peticion')
          var tipo =this.tipo_pago
          console.log(tipo)
          var fecha_inicio =this.fecha_inicio
          var fecha_final =this.fecha_final
               window.location.href = `http://127.0.0.1:8000/ReporteFechas/${tipo}/${fecha_inicio}/${fecha_final}`;
                
                    
          
        
        },

        generarReporte(){
            this.axios.get('Quincenal')
            .then();
        },

        rembolso(id){
            this.showReembolso = true
            this.pago = id
        },


         generarReemboloso(){
         this.axios.get(`/api/reembolso/${this.pago}`)
          .then()
            .catch(error => {
                console.log(error);
            });

        },
    
    }
};
</script>
