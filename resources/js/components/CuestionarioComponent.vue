<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <formulario-component
                @new="agregarRespuesta"
            ></formulario-component>
            <respuesta-component
                v-for="(respuesta, index) in respuestas"
                :key="respuesta.id"
                :respuesta="respuesta"
                @eliminar="eliminarRespuesta(index)"
            ></respuesta-component>
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
                respuestas:[]
            }
        },
        methods:{
            agregarRespuesta(respuesta){
                console.log(respuesta);
                this.respuestas.push(respuesta);
                console.log(this.respuestas)
            },
            eliminarRespuesta(index) {
                this.respuestas.splice(index,1)
            }
        }
    }
</script>
