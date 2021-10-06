
<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Alumno.</h4></div>
                <div class="card-body">
                    <form @submit.prevent="actualizar">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" v-model="person.nombre">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento :</label>
                                    <input type="date" class="form-control" v-model="person.fecha_nacimiento">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Edad :</label>
                                    <input type="number" class="form-control" v-model="person.edad">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre del Papá</label>
                                    <input type="text" class="form-control" v-model="person.nombre_papa">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Télefono del papá</label>
                                    <input type="number" class="form-control" v-model="person.telefono_papa">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre de la Mamá</label>
                                    <input type="text" class="form-control" v-model="person.nombre_mama">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Télefono de la mamá</label>
                                    <input type="number" class="form-control" v-model="person.telefono_mama">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Correo Electronico</label>
                                    <input type="text" class="form-control" v-model="person.correo_electronico">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>En caso de emergencias llamar a:</label>
                                    <input type="text" class="form-control" v-model="person.nombre_emergencia">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Telefono (Emergencia) :</label>
                                    <input type="number" class="form-control" v-model="person.telefono_emergencia">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" v-model="person.fecha_inicio">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>¿Padece de alguna enfermedad?</label>
                                    <input type="text" class="form-control" v-model="person.enfermedad">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nivel de nado: </label>
                                    <select name="nivel" id="nivel" v-model="person.nivel"   class="form-control">
                                        <option value="Bebes">Bebes</option>
                                        <option value="Mayor de 2 anos">Mayor de 2 años</option>
                                        <option value="Grupales">Grupales</option>
                                    </select>
                                   
                                </div>
                            </div>
                          
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"editar-person",
    data(){
        return {
             person:{
                nombre:"",
                fecha_nacimiento:"",
                edad:"",
                nombre_papa:"",
                telefono_papa:"",
                nombre_mama:"",
                telefono_mama:"",
                correo_electronico:"",
                nombre_emergencia:"",
                telefono_emergencia:"",
                fecha_inicio:"",
                enfermedad:"",
                nivel:"",
            

            }
        }
    },
    mounted(){
        this.mostrarperson()
    },
    methods:{
        async mostrarperson(){
            await this.axios.get(`/api/person/${this.$route.params.id}`).then(response=>{
                const { nombre,
                fecha_nacimiento,
                edad,
                nombre_papa,
                telefono_papa,
                nombre_mama,
                telefono_mama,
                correo_electronico,
                nombre_emergencia,
                telefono_emergencia,
                fecha_inicio,
                enfermedad,
                nivel,} = response.data
                this.person.nombre =nombre 
                this.person.fecha_nacimiento =fecha_nacimiento 
                this.person.edad =edad 
                this.person.nombre_papa =nombre_papa 
                this.person.telefono_papa =telefono_papa 
                this.person.nombre_mama =nombre_mama 
                this.person.telefono_mama =telefono_mama 
                this.person.correo_electronico =correo_electronico 
                this.person.nombre_emergencia =nombre_emergencia 
                this.person.telefono_emergencia =telefono_emergencia 
                this.person.fecha_inicio =fecha_inicio 
                this.person.enfermedad =enfermedad 
                this.person.nivel =nivel 
              
            }).catch(error=>{
                console.log(error)
            })
        },
        async actualizar(){
            await this.axios.put(`/api/person/${this.$route.params.id}`,this.person).then(response=>{
                this.$router.push({name:"indexPerson"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>