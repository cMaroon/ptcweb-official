<template>
    <div class="container">
      <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#addNew">
                    Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID Number</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users" :key = "user.id">
                    <td>{{user.id_num}}</td>
                    <td>{{user.firstname}} {{user.middlename}} {{user.lastname}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.usertype | upText}}</td>
                    <td>{{user.created_at | setDate}}</td>
                    <td>
                      <a href="#">
                        <i class="fa fa-edit icon-blue"></i>
                      </a>
                      /
                      <a href="#">
                        <i class="fa fa-trash icon-red"></i>
                      </a>
                    </td>
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="createUser">
              <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.id_num" type="text" name="id_num"
                      placeholder="ID Number"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('id_num') }">
                      <has-error :form="form" field="id_num"></has-error>
                    </div>
                    <div class="form-group">
                      <input v-model="form.firstname" type="text" name="firstname"
                      placeholder="First Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }">
                      <has-error :form="form" field="firstname"></has-error>
                    </div>
                    <div class="form-group">
                      <input v-model="form.middlename" type="text" name="middlename"
                      placeholder="Middle Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('middlename') }">
                      <has-error :form="form" field="middlename"></has-error>
                    </div>
                    <div class="form-group">
                      <input v-model="form.lastname" type="text" name="lastname"
                      placeholder="Last Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                      <has-error :form="form" field="lastname"></has-error>
                    </div>
                    <div class="form-group">
                      <input v-model="form.email" type="text" name="email"
                      placeholder="Email Address"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                      <select name="usertype" v-model="form.usertype" id="usertype" class="form-control" :class="{'is-invalid': form.errors.has('usertype')}">
                        <option value="presadmin">School President</option>
                        <option value="vpadmin">School Vice-President</option>
                        <option value="collegesec">College Secretary</option>
                        <option value="adminstaff">Admin Staff</option>
                        <option value="itstaff">IT Staff</option>
                        <option value="cashier">Cashier</option>
                        <option value="registrar">Registrar</option>
                        <option value="guidance">Guidance</option>
                        <option value="instructor">Instructor</option>
                        <option value="student">Student</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input v-model="form.password" type="hidden" name="password" id="password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                      <has-error :form="form" field="password"></has-error>
                      
                    </div>
                    
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create <i class="fas fa-save fa-fw"></i></button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
            users : {},
            form: new Form({
                id_num : '',
                firstname : '',
                middlename : '',
                lastname : '',
                email : '',
                password : '123456',
                usertype : 'student',
            })
          }
        },
        methods: {
          loadUsers(){
            axios.get("api/user").then(({data}) =>(this.users = data.data));

          },

          createUser(){
            this.$Progress.start();
            this.form.post('api/user');

            $('#addNew').modal('hide')

            toast({
                  type: 'success',
                  title: 'New User Successfully Created!'
                })
            this.$Progress.finish();
          }
        },
        created() {
           this.loadUsers();
           setInterval(() =>this.loadUsers(),3000);
        }
    }
</script>
