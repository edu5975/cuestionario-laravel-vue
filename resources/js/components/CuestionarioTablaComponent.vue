<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Responde las siguientes preguntas</div>
                <div class="card-body">
                    <form action="" v-on:submit.prevent="enviarFormulario()">
                        <div class="form-group">
                            <label >¿Cuál es tu nombre?</label>
                            <input type="text" class="form-control" name="pregunta" v-model="nombre">
                        </div>
                        <div class="form-group">
                            <label>¿Qué tipo de desarrollador eres?</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="tipo_desarrollador" id="optionsRadios1" value="Back-End" checked="" v-model="tipo_desarrollador">
                                    Back-end
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="tipo_desarrollador" id="optionsRadios2" value="Front-End" v-model="tipo_desarrollador">
                                    Front-end
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="tipo_desarrollador" id="optionsRadios3" value="Full-Stack" v-model="tipo_desarrollador">
                                    Full-Stack
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>¿Qué lenguajes de programación utilizas?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check1" v-model="l_java">
                                <label class="form-check-label" for="check1">
                                    Java
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check2" v-model="l_js">
                                <label class="form-check-label" for="check2">
                                    JavaScript
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check3" v-model="l_php">
                                <label class="form-check-label" for="check3">
                                    PHP
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="check4" v-model="l_python">
                                <label class="form-check-label" for="check4">
                                    Python
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >¿Qué es lo que más te gusta de programar?</label>
                            <input type="text" class="form-control" name="gustos" v-model="gustos">
                        </div>
                        <button type="submit" class="btn btn-primary">{{editar==0?'Guardar':'Editar'}}</button>
                        <button type="button" class="btn btn-secondary" v-if="editar!=0" v-on:click="limpiarFormulario()">Cancelar Edición</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Respuestas de los usuarios</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Nombre</th>
                            <th>Tipo desarrollador</th>
                            <th>Java</th>
                            <th>JavaScript</th>
                            <th>PHP</th>
                            <th>Python</th>
                            <th>Gusto</th>
                            <th>Fecha de alta</th>
                            <th>Fecha de última actualización</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(respuesta, index) in respuestas"
                                :key="respuesta.id">
                                <td>
                                    <button type="submit" class="btn btn-secondary" v-on:click="editarRespuesta(index)">Editar</button>
                                    <button type="submit" class="btn btn-danger" v-on:click="eliminarRespuesta(index)">Eliminar</button>
                                </td>
                                <td>{{respuesta.nombre}}</td>
                                <td>{{respuesta.tipo_desarrollador}}</td>
                                <td>{{respuesta.l_java?'Si':'No'}}</td>
                                <td>{{respuesta.l_js?'Si':'No'}}</td>
                                <td>{{respuesta.l_php?'Si':'No'}}</td>
                                <td>{{respuesta.l_python?'Si':'No'}}</td>
                                <td>{{respuesta.gustos}}</td>
                                <td>{{respuesta.created_at}}</td>
                                <td>{{respuesta.updated_at}}</td>
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
        mounted() {
            axios.get('/api/respuestas').then((response)=>{
                this.respuestas=response.data;
            });
        },
        data(){
            return {
                respuestas:[],
                nombre:'',
                tipo_desarrollador:'Back-End',
                l_java:false,
                l_js:false,
                l_python:false,
                l_php:false,
                gustos:'',
                editar:0,
                posicion:0,
            }
        },
        methods:{
            enviarFormulario(){
                if(this.editar==0)
                    this.nuevaRespuesta();
                else
                    this.guardarEdicionRespuesta();
            },
            nuevaRespuesta(){
                const params = {
                    nombre:this.nombre,
                    tipo_desarrollador:this.tipo_desarrollador,
                    l_java:this.l_java,
                    l_js:this.l_js,
                    l_python:this.l_python,
                    l_php:this.l_php,
                    gustos:this.gustos
                }
                axios.post('api/respuestas',params).then((res)=>{
                    const respuesta = res.data;
                    this.respuestas.push(respuesta);
                    this.limpiarFormulario();
                    alert('Se ha insertado una nueva respuesta');
                });
            },
            eliminarRespuesta(index) {
                let id = this.respuestas[index].id;
                axios.delete('api/respuestas/'+id).then(()=>{
                    this.respuestas.splice(index,1);
                    alert('Se ha insertado eliminado');
                });
            },
            editarRespuesta(index) {
                let respuesta = this.respuestas[index];
                this.posicion = index;
                this.editar = respuesta.id;
                this.nombre = respuesta.nombre;
                this.tipo_desarrollador = respuesta.tipo_desarrollador;
                this.l_java = respuesta.l_java;
                this.l_js = respuesta.l_java;
                this.l_php = respuesta.l_php;
                this.l_python = respuesta.l_python;
                this.gustos = respuesta.gustos;
            },
            guardarEdicionRespuesta(){
                const params = {
                    nombre:this.nombre,
                    tipo_desarrollador:this.tipo_desarrollador,
                    l_java:this.l_java,
                    l_js:this.l_js,
                    l_python:this.l_python,
                    l_php:this.l_php,
                    gustos:this.gustos
                }
                axios.put('api/respuestas/'+this.editar,params).then((res)=>{
                    console.log(res.data);
                    console.log(this.posicion);
                    this.respuestas[this.posicion] = res.data;
                    this.limpiarFormulario();
                    alert('Se ha editado una nueva');
                });
            },
            limpiarFormulario(){
                this.editar=0;
                this.nombre = '';
                this.tipo_desarrollador = 'Back-End';
                this.l_java = false;
                this.l_js = false;
                this.l_php = false;
                this.l_python = false;
                this.gustos = '';
            },
        }
    }
</script>
