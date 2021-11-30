<template>
<div class="container">

    <div class="row">
        <div class="col-lg-12 mb-4">
            <router-link :to="{ name: 'createSchedule' }" class="btn btn-sucess"
                ><span style="font-size:24px;"><i class="fas fa-plus-circle"></i> Nuevo</span> </router-link
            >
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table id="schedule_table" class="table table-bordered">
                    <thead style="background-color: #006699 " class=" text-white">
                        <tr>
                            <th>Id</th>
                            <th>Dias</th>
                            <th>Horario</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="schedule in schedules" :key="schedule.id">
                            <td>{{ schedule.id }}</td>
                            <td>
                                {{ schedule.Dia_inicio }}-
                                {{ schedule.Dia_final }}
                            </td>
                            <td>
                                {{ schedule.Hora_inicio }}-
                                {{ schedule.Hora_final }}
                            </td>

                            <td>
                                <!-- llamamos al componente para Editar     -->
                                <router-link
                                    :to="{
                                        name: 'editSchedule',
                                        params: { id: schedule.id }
                                    }"
                                    class="btn btn-info"
                                    ><i class="fas fa-edit"></i
                                ></router-link>
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
    name: "schedules",
    data() {
        return {
            schedules: []
        };
    },
    mounted() {
        this.mostrarSchedules();
    
    },
    methods: {
        mostrarSchedules() {
            this.axios
                .get("/api/schedule")
                .then(response => {
                    this.schedules = response.data;
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
