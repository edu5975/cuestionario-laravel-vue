<template>
    <div class="card">
        <div class="card-header">Responde las siguientes preguntas</div>
        <div class="card-body">
            <form action="" v-on:submit.prevent="nuevaRespuesta()" >
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
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                nombre:'',
                tipo_desarrollador:'Back-End',
                l_java:false,
                l_js:false,
                l_python:false,
                l_php:false,
                gustos:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
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
                    this.$emit('new',respuesta);
                });
            }
        }
    }
</script>
