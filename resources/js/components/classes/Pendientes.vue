<template>
<div class="container">

    <div class="row">
        <div class="col-lg-12 mb-4">
            <router-link :to="{ name: 'createSchedule' }" class="btn btn-sucess"
                ><i class="fas fa-plus-circle"></i> Nuevo</router-link
            >
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table id="schedule_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Id</th>
                            <th>Fecha Clase</th>
                            <th>Motivo Falta</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="classe in classes" :key="classe.id">
                            <td>{{ classe.id }}</td>
                            <td>
                                {{ classe.fecha_clase }}
                            
                            </td>
                            <td>
                                {{ classe.motivo_falta }}
                               
                            </td>

                            <td>
                                <!-- llamamos al componente para Editar     -->
                               <button class="btn btn-primary">
                                   Reasignar

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
    name: "pendientes",
    data() {
        return {
            classes: []
        };
    },
    mounted() {
        this.mostrarPendientes();
    
    },
    methods: {
        mostrarPendientes() {
            this.axios
                .get("/api/pendientes")
                .then(response => {
                    this.classes = response.data;
                          $(document).ready( function () {
                    $('#schedule_table').DataTable();
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
