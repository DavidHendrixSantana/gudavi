<template>
<div class="container">

    <div class="row">

        <div class="col-12">
            <div class="table-responsive">
                <table id="bajas_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Fecha Baja</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="baja in bajas" :key="baja.id">
                            <td>{{ baja.id }}</td>
                            <td>
                                {{ baja.nombre }}
                            </td>
                            <td>
                                {{ baja.created_at.substr(0, 10) }}
                            </td>
                            <td>
                              Acciones
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
    name: "indexBajas",
    data() {
        return {
            bajas: []
        };
    },
    mounted() {
        this.mostrarSchedules();
    
    },
    methods: {
        mostrarSchedules() {
            this.axios
                .get("/api/bajas")
                .then(response => {
                    this.bajas = response.data;
                          $(document).ready( function () {
                    $('#bajas_table').DataTable();
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
