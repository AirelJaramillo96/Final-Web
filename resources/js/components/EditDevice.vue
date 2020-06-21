<template>
    <alv-form ref="form" :action="$route('api.device.update', this.id)" method="put" @after-done="afterDone"
              :data-object="device">
        <diV class="form-group">
            <div class="col-md-12" style="text-align-last: center">
                <label for="name">Nombre *</label>
                <input type="name" id="name" name="name"
                       placeholder="Nombre del dispositivo" v-model="device.name">
            </diV>
            <div class="col-md-12" style="text-align-last: right">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>


        </diV>
    </alv-form>
</template>
<script>
    export default {
        data() {
            return {
                device: {
                    name: '',

                },

            }
        },
        props:{
            id:{
                type:Number,
                default:0
            }
        },
        created() {
            axios.get(this.route('api.device.show', this.id)).then(response => {
                this.device = response.data
            })

        },
        methods: {
            afterDone(response) {
                window.location = this.route('home');
            },

        },

    }
</script>
