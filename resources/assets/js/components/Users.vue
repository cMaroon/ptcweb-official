<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                        <input style="width:250px" class="form-control form-control-navbar" @keyup="searchthis" v-model="form.search" type="search" placeholder="Search ID Number or Fullname" aria-label="Search">
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
                  <tr v-for="user in users.data" :key = "user.id">
                    <template v-if="user.usertype!=='superadmin'">
                    <td>{{user.id_num}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.usertype | upText}}</td>
                    <td>{{user.created_at | setDate}}</td>
                    <td>
                      <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                  </template>
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Users : {{totalrecord}}</p>

                  <pagination :data="users" :limit="2" @pagination-change-page="getResults">
                    <span slot="prev-nav"><i class="fas fa-chevron-circle-left"></i></span>
                    <span slot="next-nav"><i class="fas fa-chevron-circle-right"></i></span>
                  </pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isSuperAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateUser() : createUser()">
              <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.id_num" type="text" name="id_num"
                      placeholder="ID Number"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('id_num') }">
                      <has-error :form="form" field="id_num"></has-error>
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
                    <button v-show="editmode" type="submit" class="btn btn-success">Update <i class="fas fa-pen fa-fw"></i></button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create <i class="fas fa-save fa-fw"></i></button>
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
            editmode: false,
            users : {},
            totalrecord:'',
            form: new Form({
                id : '',
                id_num : '',
                email : '',
                password : '123456',
                usertype : 'student',
                search:''
            })
          }
        },
        methods: {
          searchthis(){
                let query = this.form.search;
                axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                    this.totalrecord= data.data.total

                })
                .catch(() => {
                        swal("Failed!", "No Record Found!.", "warning");
                })

        },
          getResults(page = 1) {
            axios.get('api/user?page=' + page)
                .then(response => {
                    this.users = response.data;
                });
          },
          updateUser(){
                this.$Progress.start();
                // console.log('Editing data');
                // this.form.put('api/studentlist/'+this.form.id_num)
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
             deleteUser(id){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/user/'+id).then(()=>{
                                        swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterCreate');
                                }).catch(()=> {
                                    swal("Failed!", "UNAUTHORIZED ACTION.", "warning");
                                });
                         }
                    })
            },
          loadUsers(){
            if(this.$gate.isSuperAdmin()){
                axios.get("api/user").then(({data}) =>(this.users = data))
                .then($data=>{this.totalrecord=$data.total-1});

            }

            
          },

          createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                this.form.post('api/student')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'User Created in successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  this.$Progress.fail();
                })
            }
        },
        created() {
           this.loadUsers();
           Fire.$on('AfterCreate',() => {
               this.loadUsers();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
