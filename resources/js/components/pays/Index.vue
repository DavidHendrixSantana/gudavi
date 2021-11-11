<template>
<div class="container">
<br>
    <div class="row">
        <div class="col-lg-12 mb-4">
             <router-link to="/QuincenalPersons" target="_blank" type="button" class="btn btn-success">Generar Reporte</router-link>
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
        generarReporte(){
            this.axios.get('Quincenal')
            .then();
        }
    }
};
</script>
