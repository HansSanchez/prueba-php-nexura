<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h1>Lista de empleados</h1>
            </v-col>
            <v-col cols="6" class="text-left">
                <v-dialog v-model="dialogCreate" transition="dialog-bottom-transition" fullscreen persistent
                    :retain-focus="false">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="bg-primary" dark v-bind="attrs" v-on="on" @click="update = false; reset()">
                            <v-icon class="mr-5px">mdi-account-plus</v-icon>
                            Crear
                        </v-btn>
                    </template>
                    <v-toolbar dark color="bg-primary">
                        <v-btn icon dark @click="dialogCreate = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Nuevo empleado</v-toolbar-title>
                    </v-toolbar>
                    <v-card>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-alert class="bg-info">
                                        <p class="mb-0">Los campos con asteriscos (*) son obligatorios</p>
                                    </v-alert>
                                </v-col>
                                <v-col cols="12">
                                    <v-form ref="form" v-model="valid" lazy-validation>
                                        <v-row>
                                            <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                <v-text-field v-model="FormEmployee.name" :counter="30"
                                                    :rules="nameRules" label="Nombre Completo *" required>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                <v-text-field v-model="FormEmployee.email" :counter="30"
                                                    :rules="emailRules" label="Correo electrónico *" required>
                                                </v-text-field>
                                            </v-col>
                                            <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                <v-radio-group v-model="FormEmployee.sex" row label="Sexo *">
                                                    <v-radio label="Masculino" value="M"></v-radio>
                                                    <v-radio label="Feminino" value="F"></v-radio>
                                                </v-radio-group>
                                            </v-col>
                                            <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                <v-select v-model="FormEmployee.area" :items="areas" :item-text="'name'"
                                                    :item-value="'id'" :rules="areaRules" label="Área *" required>
                                                </v-select>
                                            </v-col>
                                            <v-col cols="12" xl="12" lg="12" md="12" sm="12" xs="12">
                                                <v-select v-model="FormEmployee.roles" :items="roles" multiple
                                                    :item-text="'name'" :item-value="'id'" :rules="roleRules"
                                                    label="Roles *" required>
                                                </v-select>
                                            </v-col>
                                            <v-col cols="12" xl="12" lg="12" md="12" sm="12" xs="12">
                                                <v-textarea label="Descripción *" :counter="255"
                                                    v-model="FormEmployee.description" :rules="descriptionRules"
                                                    rows="3" placeholder="Descripción de la experiencia del empleado">
                                                </v-textarea>
                                            </v-col>
                                            <v-col cols="12" xl="12" lg="12" md="12" sm="12" xs="12">
                                                <v-checkbox v-model="FormEmployee.bulletin"
                                                    label="Deseo recibir boletin informativo" required>
                                                </v-checkbox>
                                            </v-col>
                                            <v-col cols="12" xl="12" lg="12" md="12" sm="12" xs="12">
                                                <v-btn :disabled="!valid" color="bg-primary" class="w-100"
                                                    @click="createOrUpdate()">
                                                    Guardar
                                                </v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card>
                </v-dialog>
            </v-col>
            <v-col cols="6" class="text-rigth">
                <v-text-field hide-details label="Buscar..." placeholder="Search" filled dense single-line full-width
                    @change="changeType" v-model="searchInput" id="search" @click:append="clean" class="shrink">
                    <template v-slot:append>
                        <v-hover v-slot="{ hover }">
                            <v-icon :color="hover ? '#01ab91' : ''" @click="clean()">
                                mdi-refresh
                            </v-icon>
                        </v-hover>
                    </template>
                </v-text-field>
            </v-col>
            <v-col cols="12">
                <v-simple-table light dense>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Sexo</th>
                                <th class="text-left">Área</th>
                                <th class="text-left">Roles</th>
                                <th class="text-left">Boletín</th>
                                <th class="text-left">Modificar</th>
                                <th class="text-left">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in list" :key="index">
                                <td>{{ item.name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.sex }}</td>
                                <td>{{ item.area.name }}</td>
                                <td>
                                    <ul v-for="(role, id) in item.roles" :key="id">
                                        <li>{{ role.name }}</li>
                                    </ul>
                                </td>
                                <td>{{ item.BulletinLabel }}</td>
                                <td>
                                    <v-dialog v-model="dialogUpdate" transition="dialog-bottom-transition" fullscreen
                                        :retain-focus="false" persistent>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn @click="EmployeeSelected = item; update = true;" color="bg-warning"
                                                dark v-bind="attrs" v-on="on" small>
                                                <v-icon>mdi-square-edit-outline</v-icon>
                                            </v-btn>
                                        </template>
                                        <v-toolbar dark color="bg-primary">
                                            <v-btn icon dark @click="dialogUpdate = false">
                                                <v-icon>mdi-close</v-icon>
                                            </v-btn>
                                            <v-toolbar-title>Actualizar empleado</v-toolbar-title>
                                        </v-toolbar>
                                        <v-card>
                                            <v-container>
                                                <v-row>
                                                    <v-col cols="12" md="12">
                                                        <v-alert class="bg-info">
                                                            <p class="mb-0">Los campos con asteriscos (*) son
                                                                obligatorios</p>
                                                        </v-alert>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-form ref="form" v-model="valid" lazy-validation>
                                                            <v-row>
                                                                <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                                    <v-text-field v-model="EmployeeSelected.name"
                                                                        :counter="30" :rules="nameRules"
                                                                        label="Nombre Completo *" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                                    <v-text-field v-model="EmployeeSelected.email"
                                                                        :counter="30" :rules="emailRules"
                                                                        label="Correo electrónico *" required>
                                                                    </v-text-field>
                                                                </v-col>
                                                                <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                                    <v-radio-group v-model="EmployeeSelected.sex" row
                                                                        label="Sexo *">
                                                                        <v-radio label="Masculino" value="M"></v-radio>
                                                                        <v-radio label="Feminino" value="F"></v-radio>
                                                                    </v-radio-group>
                                                                </v-col>
                                                                <v-col cols="12" xl="6" lg="6" md="6" sm="12" xs="12">
                                                                    <v-select v-model="EmployeeSelected.area"
                                                                        :items="areas" :item-text="'name'"
                                                                        :item-value="'id'" :rules="areaRules"
                                                                        label="Área *" required>
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col cols="12" xl="12" lg="12" md="12" sm="12"
                                                                    xs="12">
                                                                    <v-select v-model="EmployeeSelected.roles"
                                                                        :items="roles" multiple :item-text="'name'"
                                                                        :item-value="'id'" :rules="roleRules"
                                                                        label="Roles *" required>
                                                                    </v-select>
                                                                </v-col>
                                                                <v-col cols="12" xl="12" lg="12" md="12" sm="12"
                                                                    xs="12">
                                                                    <v-textarea label="Descripción *" :counter="255"
                                                                        v-model="EmployeeSelected.description"
                                                                        :rules="descriptionRules" rows="3"
                                                                        placeholder="Descripción de la experiencia del empleado">
                                                                    </v-textarea>
                                                                </v-col>
                                                                <v-col cols="12" xl="12" lg="12" md="12" sm="12"
                                                                    xs="12">
                                                                    <v-checkbox v-model="EmployeeSelected.bulletin"
                                                                        label="Deseo recibir boletin informativo"
                                                                        required>
                                                                    </v-checkbox>
                                                                </v-col>
                                                                <v-col cols="12" xl="12" lg="12" md="12" sm="12"
                                                                    xs="12">
                                                                    <v-btn :disabled="!valid" color="bg-primary"
                                                                        class="w-100" @click="createOrUpdate();">
                                                                        Actualizar
                                                                    </v-btn>
                                                                </v-col>
                                                            </v-row>
                                                        </v-form>
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-card>
                                    </v-dialog>
                                </td>
                                <td>
                                    <v-btn class="bg-danger" small @click="destroy(item.id)">
                                        <v-icon>mdi-trash-can-outline</v-icon>
                                    </v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
                <br>
                <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler" spinner="waveDots"
                    ref="infiniteHandler">
                    <div slot="no-more">
                        No hay más empleados
                    </div>
                    <div slot="no-results">
                        No hay empleados
                    </div>
                </infinite-loading>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading"; // Componente para hacer un scroll infinito el cual solo me hace una consulta inicial de 10 registros esto se complementa con el controlador y un simplePaginate

export default {
    name: "Employee",
    components: {
        InfiniteLoading,
    },
    data() {
        return {
            id: '',
            page: 1,
            list: [],
            infiniteId: +new Date(),
            searchInput: '',
            setTimeoutSearch: '',
            dialogCreate: false,
            dialogUpdate: false,
            valid: true,
            update: false,
            EmployeeSelected: {
                name: '',
                email: '',
                sex: 'M',
                area: '',
                bulletin: false,
                description: '',
                roles: '',
            },
            nameRules: [
                v => !!v || 'El nombre del empleado es requerido',
                v => (v && v.length <= 30) || 'El nombre excede la cantidad de caracteres',
            ],
            emailRules: [
                v => !!v || 'El correo electrónico es requerido',
                v => /.+@.+\..+/.test(v) || 'El correo electrónico tiene un formato invalido',
                v => (v && v.length <= 30) || 'El correo electrónico excede la cantidad de caracteres',
            ],
            areaRules: [
                v => !!v || 'El área es requerida',
            ],
            roleRules: [
                v => !!v || 'Al menos 1 rol es requerido',
            ],
            descriptionRules: [
                v => !!v || 'La descripción de la experiencia es requerida',
                v => (v && v.length <= 255) || 'La descripción excede la cantidad de caracteres',
            ],
            areas: [],
            roles: [],
            FormEmployee: {
                name: '',
                email: '',
                sex: 'M',
                area: '',
                bulletin: false,
                description: '',
                roles: '',
            }
        }
    },
    methods: {
        infiniteHandler($state) {
            let api = "/employees/getEmployees";
            axios.get(api, { params: { page: this.page, search: this.searchInput } })
                .then(({ data }) => {
                    if (data.employees.data.length > 0) {
                        this.page += 1;
                        this.list.push(...data.employees.data);
                        $state.loaded();
                    } else $state.complete();
                }).catch(error => (error.response ? this.response(error) : ""));
        },
        changeType() {
            this.page = 1;
            this.list = [];
            this.infiniteId += 1;
        },
        clean() {
            this.searchInput = null;
            this.changeType();
        },
        reset() {
            this.$refs.form.reset();
        },
        createOrUpdate() {
            let valid = null;
            if (this.update) valid = this.$refs.form[0].validate();
            else valid = this.$refs.form.validate();

            if (!valid) console.log("No pasó");
            else {
                let url = this.update ? '/employees/' + this.EmployeeSelected.id + '/update' : '/employees/store';
                let employee = this.update ? this.EmployeeSelected : this.FormEmployee
                axios.post(url, employee)
                    .then(response => {
                        this.alerts(response.data); // Es un método personalizado para mostrar una alerta con un SweetAlert
                        if (!response.data.new) this.list.splice(this.list.findIndex(element => (element.id === response.data.employee.id)), 1);
                        this.list.unshift(response.data.employee); // unshift sirve para agregar el elemento al array al inicio, push lo agrega al final
                        this.dialogCreate = false;
                        this.dialogUpdate = false;
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            // CAPTURA DE ERRORES DESDE EL BACKEND
                            let msg = ''

                            // RECORRE TODOS LOS ERRORES Y LOS ADJUNTA EN UNA VARIABLE
                            Object.values(error.response.data.errors)
                                .map((errors, index) =>
                                    msg += `<li style="margin-bottom: 10px !important; text-align: left !important;">${errors[0]}</li>`)

                            // ALERTA QUE MUESTRA AL USUARIO FINAL LOS ERRORES
                            this.$swal({
                                icon: 'error', // ICONO LLEGA DEL BACK
                                title: '¡Hola! te invitamos a que revises tús campos',
                                html: `<ul class="text-danger text-left">${msg}</ul>`, // VALIDACIONES DE REGLAS DEL BACK
                                showConfirmButton: false, // EVITA QUE EL USUARIO CIERRE SIN LEER LOS ERRORES
                                timer: 5000, // 10 SEG PARA QUE EL USUARIO LEA
                                timerProgressBar: true,
                            })
                        } else this.response(error);
                    });
            }
        },
        destroy(id) {
            this.$swal({
                title: '¿Realmente desea eliminar este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    axios.delete('/employees/' + id + '/destroy')
                        .then(response => {
                            this.$toastr.Add({
                                timeout: 5000,
                                type: response.data.icon,
                                msg: response.data.msg
                            })
                            this.list.splice(this.list.findIndex(element => (element.id === response.data.employee.id)), 1);
                        }).catch(error => (error.response) ? this.response(error) : '');
                } else {
                    this.$swal({
                        icon: 'success',
                        title: 'Se canceló con éxito',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        },
        getAreas(search, loading) { // Función para traer los lotes en un v-select
            axios.get('/areas/getAreas', { params: { search: search } })
                .then(response => this.areas = response.data.data)
                .catch(error => (error.response) ? this.response(error) : '');
        },
        getRoles(search, loading) { // Función para traer los lotes en un v-select
            axios.get('/roles/getRoles', { params: { search: search } })
                .then(response => this.roles = response.data.data)
                .catch(error => (error.response) ? this.response(error) : '');
        },
        response(error) {
            if (error.response.status === 500) {
                this.$swal({
                    icon: error.response.data.icon,
                    title: 'Oops!',
                    html: '<p>Ocurrio un error con el servidor...</p>' +
                        '<p class="text-justify">Por favor espere mientras trabajamos para brindarle una pronta solución, ' +
                        'si el error persiste pongase en contacto con el área de sistemas.' + '</p>' +
                        '<p class="text-justify"><b class="text-danger">Error:</b> ' + error.response.data.msg + '</p>',
                    showConfirmButton: false,
                });
            }
        },
        alerts(response) {
            this.$swal({
                icon: response.icon,
                title: response.msg,
                showConfirmButton: false,
                timer: 1000
            });
        },
    },
    created() {
        this.getAreas();
        this.getRoles();
    }
}
</script>

<style scoped>
.text-rigth {
    text-align: end !important;
}

.text-left {
    text-align: left !important;
}

.bg-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-weight: bold;
}

.bg-info {
    color: #fff;
    background-color: #0dcaf0;
    border-color: #0dcaf0;
    font-weight: bold;
}

.bg-warning {
    background-color: #f9b115 !important;
}

.bg-danger {
    color: #fff;
    background-color: #e55353 !important;
}

.v-messages__message {
    color: red !important;
    font-weight: bold;
}

.mr-5px {
    margin-right: 5px;
}

.w-100 {
    width: 100% !important;
}
</style>
