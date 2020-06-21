
<template>
    <v-server-table :url="$route('api.device.index')"   :columns="columns" ref="table" :options="options" :filterByColumn="true" >
        <div slot="actions" slot-scope="props" class="action-buttons">
            <div class="btn-group ">
                <a href="#">
                    <button title="Ver" :data-id="props.row.id" type="button" class="btn btn-circle btn-sm btn-success">
                        <i class="fa fa-eye"></i></button>
                </a>
                <a href="#">
                    <button title="Editar" :data-id="props.row.id" type="button" class="btn btn-circle btn-sm btn-info">
                        <i class="fa fa-edit"></i></button>
                </a>
                <button title="Eliminar" :data-id="props.row.id" @click="eliminarRegistro(props.row.id)"
                        class="btn btn-circle btn-sm btn-danger "><i class="fa fa-trash"></i></button>

            </div>
        </div>
    </v-server-table>
</template>

<script>
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                options: {
                    debounce: 1500,
                    perPage: 50,
                    perPageValues: [10, 25, 50, 100],
                    filterByColumn: true,
                    headings: {
                        id: "ID",
                        name: "Nombre",
                        stateName: "Estado",
                        actions: "Acciones",
                    },
                    pagination: {
                        chunk: 10,
                    },
                    texts: {
                        count: "Mostrando {from} - {to} de {count} registros|{count} registros|Un registro",
                        first: 'Primero',
                        last: 'Ultimo',
                        filter: "Filtrar:",
                        filterPlaceholder: "Consulta",
                        limit: "Registros:",
                        page: "Página:",
                        noResults: "No se encontraron registros",
                        filterBy: "Filtrar por {column}",
                        loading: 'Cargando...',
                        defaultOption: 'Selecciona {column}',
                        columns: 'Columnas'
                    }
                },
                actionsColumn: "actions",
                columns: ['id', 'name', 'state_name', 'actions'],
            }
        },
        methods: {
            eliminarRegistro(id) {
                Swal.fire({
                    title: '¿Estas Seguro?',
                    text: "Este registro ya no se podra recuperar!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.value) {

                        Swal.fire(
                            'Éxito!',
                            'El registro se eliminó correctamente.',
                            'success'
                        )
                    }
                });
            },

        }
    }
</script>
