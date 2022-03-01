<template>
    <div>
        <br>
        <div class="card">
            <div class="card-header">Respuesta de {{respuesta.nombre}} - ({{respuesta.created_at}})</div>
            <div class="card-body">
                <p>Soy {{respuesta.tipo_desarrollador}}</p>
                Uso los lenguajes de:
                <ul>
                    <li v-if="respuesta.l_java">Java</li>
                    <li v-if="respuesta.l_js">JavaScript</li>
                    <li v-if="respuesta.l_python">Python</li>
                    <li v-if="respuesta.l_php">PHP</li>
                </ul>
                <p>Lo que más me gusta de programar es... {{respuesta.gustos}}</p>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-secondary" v-on:click="editarRespuesta()">Editar</button>
                <button type="submit" class="btn btn-danger" v-on:click="eliminarRespuesta()">Eliminar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        props:['respuesta'],
        methods:{
            eliminarRespuesta(){
                axios.delete('api/respuestas/'+this.respuesta.id).then(()=>{
                    this.$emit('eliminar');
                });
            },
            editarRespuesta() {
                this.$emit('editar');
            }
        }
    }
</script>
