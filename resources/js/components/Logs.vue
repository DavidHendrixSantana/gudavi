<template>
<div class="container">

    <div class="row">


        <div class="col-12">
            <div class="table-responsive">
                <table id="logs_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Id</th>
                            <th>Acción</th>
                            <th>Usuario</th>
                            <th>Fecha</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="log in logs" :key="log.id">
                            <td>{{ log.id }}</td>
                            <td>
                                {{ log.Log }}
                            </td>
                            <td>
                                {{ log.usuario }}
                            </td>
                            <td>
                                {{  log.created_at.substr(0, 10) }}
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
    name: "indexLogs",
    data() {
        return {
            logs: []
        };
    },
    mounted() {
        this.mostrarSchedules();
    
    },
    methods: {
        mostrarSchedules() {
            this.axios
                .get("/api/logs")
                .then(response => {
                    this.logs = response.data;
                          $(document).ready( function () {
                    $('#logs_table').DataTable({
                         order: [[0, 'desc']],
                    });
                } );
              
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
