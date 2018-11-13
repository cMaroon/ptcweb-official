<template>
    <div class="container">
      <div class="row " v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List Table</h3>

                <div class="card-tools">

                 <!-- {{studentlist.data.id_num}} -->
                   <!-- <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID Number</th>
                    <th>Fullname</th>
                    <th>Program</th>
                    <th>Year and Section </th>
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="student in studentlist.data" :key = "student.id">
                    <!-- <template v-if="user.usertype!=='superadmin'"> -->
                    <td>{{student.id_num}}</td>
                    <td>{{student.firstname}} {{student.middlename}} {{student.lastname}} {{student.suffixname}}</td>
                    <td>{{student.studprograms.program_code}}</td>
                    <td>{{student.studyearlevel.title}} - {{student.studsection.title}}</td>
                    <td>{{student.created_at | setDate}}</td>
                    <td>
                      <a href="#" @click="editModal(student)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteStudent(student.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                  <!-- </template> -->
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Students : {{totalrecord}}</p>

                  <pagination :data="studentlist" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Student's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateStudent() : createStudent()">
              <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.id_num" type="text" name="id_num"
                      placeholder="ID Number"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('id_num') }" >
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
                      <input v-model="form.suffixname" type="text" name="suffixname"
                      placeholder="Suffix Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('suffixname') }">
                      <has-error :form="form" field="suffixname"></has-error>
                    </div>

                    <div class="form-group">
                    <select  type="text" name="program_id" class="form-control"  required v-model="form.program_id" >
                            <option value="">Please select program*</option>
                        <option v-for="pr in programs.data" :key="pr.id" v-bind:value="pr.id">{{pr.descriptive_title}}</option>

                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" name="year_level" class="form-control"  required v-model="form.year_level" >
                            <option value="">Please select year level*</option>
                        <option v-for="yl in yearlevel.data" :key="yl.id" v-bind:value="yl.id">{{yl.title}}</option>

                    </select>
                    </div>

                    <div class="form-group">
                            <select  type="text" name="section" class="form-control"  required  v-model="form.section">
                                    <option value="">Please select section*</option>
                          <option v-for="sec in section.data" :key="sec.id" v-bind:value="sec.id">{{sec.title}}</option>
                            </select>

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
            studentlist : {},
            programs : {},
            yearlevel:{},
            section:{},
            totalrecord:'',
            form: new Form({
                id: '',
                id_num: '',
                firstname:'',
                middlename:'',
                lastname:'',
                suffixname:'',
                program_id:'',
                year_level:'',
                section:'',

            })
          }
        },

        methods: {
          getResults(page = 1) {
            axios.get('api/studentlist?page=' + page)
                .then(response => {
                    this.studentlist = response.data;
                    
                });
          },
          updateStudent(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/studentlist/'+this.form.id)
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
            editModal(student){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(student);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
             deleteStudent(id){
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
                                this.form.delete('api/studentlist/'+id).then(()=>{
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
          loadStudents(){
            if(this.$gate.isSuperAdmin()){
                axios.get("api/program").then(({data}) =>(this.programs = data))
                axios.get("api/yearlevel").then(({data}) =>(this.yearlevel = data))
                axios.get("api/section").then(({data}) =>(this.section = data))
                axios.get("api/studentlist").then(({data}) =>(this.studentlist = data))
                .then($data=>{this.totalrecord=$data.total});

            }
            
          }

          // createUser(){
          //       this.$Progress.start();
          //       // this.form.post('api/user')
          //       // this.form.post('api/student')
          //       .then(()=>{
          //           Fire.$emit('AfterCreate');
          //           $('#addNew').modal('hide')
          //           toast({
          //               type: 'success',
          //               title: 'User Created in successfully'
          //               })
          //           this.$Progress.finish();
          //       })
          //       .catch(()=>{
          //         this.$Progress.fail();
          //       })
          //   }
        },
        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findStudent?q=' + query)
                .then((data) => {
                    this.studentlist = data.data
                    this.totalrecord= data.data.total

                })
                .catch(() => {
                  // swal("Failed!", "No Record Found!.", "warning");
                })
            })
           this.loadStudents();
           Fire.$on('AfterCreate',() => {
               this.loadStudents();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
