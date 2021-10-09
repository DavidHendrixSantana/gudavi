<template>
    <main>
        <div class="row">
            <div class="col-4" v-for="teacher in Teachers" :key="teacher.id">
                <div class="row">
                    <button
                        type="button"
                        v-on:click="cargar_clases($event)"
                        :value="teacher.id"
                        :id="teacher.id"
                        class="btn btn-primary"
                        data-toggle="button"
                        aria-pressed="false"
                        autocomplete="off"
                    >
                        {{ teacher.nombre }}
                    </button>
                </div>
            </div>
        </div>

        <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-for="teacher in Teachers" :key="teacher.id">
        <input type="radio" class="btn-check" name="btnradio"   v-on:click="cargar_clases($event)" v-model="teacher_id" :id="teacher.id" autocomplete="off">
        <label class="btn btn-outline-primary" for="teacher.id">{{teacher.nombre}}</label> -->

        <div>
            <table class="table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" v-for="day in Days" :key="day.id">
                            {{ day.Dia }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td v-for="day in Days" :key="day.id">
                            <button
                                v-for="clase in day.Clases"
                                :key="clase.id"
                                type="button"
                                class="clase_normal"
                                @click="show_modal($event)"
                                :value="clase.nombre"
                            >
                                {{ clase.Clase }}
                                {{ clase.nombre }}
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Modificar la clase de: {{ person_name }}
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
                                    <p>Acciones en la clase.</p>
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                    >
                                        No se presentara.
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                    >
                                        Solicitar cambio.
                                    </button>
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
    </main>
</template>

<script>
export default {
    name: "Listado",
    data() {
        return {
            teacher_id: "",
            Days: [],
            Teachers: [],
            showModal: false,
            person_name: ""
        };
    },

    mounted() {
        this.mostrarDatos();
    },
    methods: {
        async mostrarDatos() {
            await this.axios
                .get(`/api/listado`)
                .then(response => {
                    const { Days, Teachers } = response.data;
                    this.Days = Days;
                    this.Teachers = Teachers;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async cargar_clases(event) {
            console.log(event.target.value);
            var id = event.target.value;
            await this.axios
                .get(`/api/listado_teacher/${event.target.value}`)
                .then(response => {
                    const { Days } = response.data;
                    this.Days = Days;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        show_modal(event) {
            this.person_name = event.target.value;
            this.showModal = true;
        }
    }
};
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
.clase_normal:hover {
    background-color: #0688fa;
}
.clase_normal:active {
    position: relative;
    top: 1px;
}
</style>
