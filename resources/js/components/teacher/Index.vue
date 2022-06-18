<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <router-link
                    :to="{ name: 'createTeacher' }"
                    class="btn btn-sucess"
                    ><span style="font-size:24px;"
                        ><i class="fas fa-plus-circle"></i> Nuevo</span
                    >
                </router-link>
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table id="teacher_table" class="table table-striped">
                        <thead
                            style="background-color: #006699 "
                            class=" text-white"
                        >
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Turno</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="teacher in Teachers" :key="teacher.id">
                                <td>{{ teacher.id }}</td>
                                <td>{{ teacher.nombre }}</td>
                                <td>{{ teacher.rfc }}</td>

                                <td>
                                    <!-- llamamos al componente para Editar     -->
                                    <router-link
                                        :to="{
                                            name: 'editTeacher',
                                            params: { id: teacher.id }
                                        }"
                                        class="btn btn-info"
                                        ><i class="fas fa-edit"></i
                                    ></router-link>
                                    <button
                                        @click="imprimirCredencial(teacher.id)"
                                        type="button"
                                        class="btn btn-success"
                                    >
                                        Imprimir credencial
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
    name: "teachers",
    data() {
        return {
            Teachers: []
        };
    },
    mounted() {
        this.mostrarTeachers();
    },

    methods: {
        mostrarTeachers() {
            this.axios
                .get("/api/teacher")
                .then(response => {
                    this.Teachers = response.data;

                    $(document).ready(function() {
                        $("#teacher_table").DataTable();
                    });
                    console.log(this.Teachers);

                    // let table = new DataTable('#teacher_table', {
                    //       data:  this.Teachers ,
                    //         columns: [
                    //         { data: 'id' },
                    //         { data: 'nombre' },
                    //         { data: 'rfc' },

                    //     ]
                    //     });
                })
                .catch(error => {
                    console.log(error);
                });
        },

        imprimirCredencial(id) {
            //  window.location.href = `http://localhost/credencial/${id}`;
            window.open(`credencialT/${id}`);
        }
    }
};
</script>
