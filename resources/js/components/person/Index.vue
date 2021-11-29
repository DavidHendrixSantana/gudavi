<template>
<div class="container">
<div class="row">
    <div class="col-lg-12 mb-4">
        <router-link :to='{name:"createPerson"}' class="btn btn-sucess"><i class="fas fa-plus-circle"></i>  Nuevo</router-link>
    </div>

  <div class="col-12">             
                    <div class="table-responsive">
                        <table id="person_table" class="table table-striped">
                            <thead style="background-color: #006699 " class=" text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                   
                         
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="person in Persons" :key="person.id">
                                    <td>{{ person.id }}</td>
                                    <td>{{ person.nombre }}</td>
                                  
                                    <td>
                                        <!-- llamamos al componente para Editar     -->
                                        <router-link :to='{name:"editPerson",params:{id:person.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                       
                                       <button
                                            type="button"
                                            @click="show_modal($event)"
                                            :value="person.id "
                                        >Realizar pago.
                                     </button>
                                <button type="button" class="btn btn-warning">Dar de baja Temporal</button>
                                <button type="button" @click="borrarPerson(person.id)" class="btn btn-danger">Dar de baja</button>
                                          <router-link to="/credencial" target="_blank" type="button" class="btn btn-success">Imprimir credencial</router-link>


                                       
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>                          
        </div>

<div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Datos del pago de: 
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        <span
                                            aria-hidden="true"
                                            @click="showModal = false"
                                            >&times;</span
                                        >
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Información del pago.</p>
                                    <h5>Fecha del pago: {{fecha_pago}}</h5>
                                    <h5>Monto del pago: {{cantidad}}</h5>
                                    <h5>Fecha de vencimiento: {{fecha_vencimiento}}</h5>
                                    <div v-if="showPayValue">
                                            <label for="forma-pago">Forma de pago:</label>

                                        <select name="forma-pago" class="form-control" v-model="formaPago" id="forma-pago">
                                              <option value="">Seleccione una opción</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                        </select>
                                        <div v-if="this.formaPago === 'Tarjeta'">
                                            <label for="Numero">Tipo Tarjeta:</label>
                                        <select class="form-control" id="Numero1" v-model="tarjetaPago" >
                                                <option value="Debito">Debito</option>
                                                <option value="Credito">Credito</option>
                                        </select>
                                        </div>
                                        <label for="cantidad">Cantidad:</label>
                                        <input class="form-control" id="cantidad" type="text" v-model="cantidad" disabled>
                                            <br>
                                            <br>
                                            
                                        <button @click="generarPago()"  align="center" type="button" class="btn btn-success btn-lg">Realizar Pago</button>


                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        @click="showModal = false"
                                    >
                                        Cerrar
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                    >
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>



</div>
    </div>
</template>

<script>


export default {
    name:"persons",
    data(){
        return{
            showModal: false,
            showPay: false,
            showPayValue: false,
            Persons:[],
            Pay:[],
            PayHistory:[],
            fecha_pago:"",
            fecha_vencimiento:"",
            cantidad:"",
            status: '',
            formaPago:'',
            tarjetaPago:'',
            id_person: '',
            respuesta: '',
          
            
        }
    },
    mounted(){
        this.mostrarPersons()
      
    },
    methods:{
        mostrarPersons(){
            this.axios.get('/api/person').then(response=>{
               this.Persons = response.data
               console.log(this.Persons)
                 $(document).ready( function () {
                    $('#person_table').DataTable();
                });
            }).catch(error=>{
                console.log(error)
            })
        },

         borrarPerson(id){
            if(confirm("¿Confirma eliminar el registro?")){
                this.axios.delete(`/api/person/${id}`).then(response=>{
                    this.mostrarPersons()
                }).catch(error=>{
                    console.log(error)
                })
            }
         },

        async  show_modal(event) {
             var id = event.target.value;
             this.id_person = id;
           

             await this.axios
                .get(`/api/pago/${event.target.value}`)
                .then(response => {
                    const { pay } = response.data;
                   
                    this.fecha_pago=pay.fecha_pago
                    this.cantidad = pay.cantidad
                    this.status = pay.status

                  let date = new Date()

                    let day = date.getDate()
                    let month = date.getMonth() + 2
                    let year = date.getFullYear()

                    if(month < 10){
                        this.fecha_vencimiento = `08-0${month}-${year}`
                 
                    }else{
                        this.fecha_vencimiento = `08-${month}-${year}`

                    }
                    if(this.fecha_vencimiento > `${day}-${month}-${year}`){
                            this.cantidad = this.cantidad*1.10
                                if(month < 10){
                                    this.fecha_vencimiento = `11-0${month}-${year}`
                        
                                }else{
                                        this.fecha_vencimiento = `11-${month}-${year}`

                                }
                    }
                   
                   
                    if(this.status === 0 ){
                        this.showPayValue =true
                    }
                   



                })
                .catch(error => {
                    console.log(error);
                });
                

            this.showModal = true;

        },
        async generarPago(){
            this.formaPago === 'Efectivo' ? this.tarjetaPago='Efectivo' : this.tarjetaPago; 
            console.log(this.PayHistory)
            await this.axios.get(`/api/realizarPago/${this.id_person}/${this.formaPago}/${this.tarjetaPago}/${this.cantidad}`).then(response=>{
               const { respuesta }= response.data
                 console.log(respuesta)
            }).catch(error=>{
                console.log(error)
            })
          

        }
    },

   

}
</script>

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
}

.clase_normal {
    box-shadow: inset 0px -3px 7px 0px #2c7a9e;
    background-color: #267fb3;
    border-radius: 3px;
    border: 1px solid #0b0e07;
    width: 180px;
    min-height: 50px;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 15px;
    padding: 12px 37px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #263666;
}

</style>
