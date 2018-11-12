<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Courses Table</h3>

                <div class="card-tools">
                   <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-plus-square fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Course Code</th>
                    <th>Descriptive Title</th>
                    <th>Lecture Hour</th>
                    <th>Laboratory Hour</th>
                    <th>Course Unit</th>
                    <th>Course Pre-requisite</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="course in courses.data" :key = "course.id">
                 
                    <td>{{course.course_code}}</td>
                    <td>{{course.descriptive_title}}</td>
                    <td>{{course.lec_hr}}</td>
                    <td>{{course.lab_hr}}</td>
                    <td>{{course.course_unit}}</td>
                    <td>{{course.course_pre_req}}</td>
                    <td>
                      <a href="#" @click="editModal(course)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteCourse(course.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Courses : {{totalrecord}}</p>

                  <pagination :data="courses" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Course's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateCourse() : createCourse()">
              <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.course_code" type="text" name="course_code"
                      placeholder="Course Code"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('course_code') }">
                      <has-error :form="form" field="course_code"></has-error>
                    </div>
                    
                    <div class="form-group">
                      <input v-model="form.descriptive_title" type="text" name="descriptive_title"
                      placeholder="Descriptive Title"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('descriptive_title') }">
                      <has-error :form="form" field="descriptive_title"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.lec_hr" type="text" name="lec_hr"
                      placeholder="Lecture Hour"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('lec_hr') }">
                      <has-error :form="form" field="lec_hr"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.lab_hr" type="text" name="lab_hr"
                      placeholder="Laboratory Hour"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('lab_hr') }">
                      <has-error :form="form" field="lab_hr"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.course_unit" type="text" name="course_unit"
                      placeholder="Course Unit"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('course_unit') }">
                      <has-error :form="form" field="course_unit"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.course_pre_req" type="text" name="course_pre_req"
                      placeholder="Course Pre-requisite"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('course_pre_req') }">
                      <has-error :form="form" field="course_pre_req"></has-error>
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
            courses : {},
            totalrecord:'',
            form: new Form({
                id : '',
                course_code : '',
                descriptive_title : '',
                lec_hr : '',
                lab_hr : '',
                course_unit : '',
                course_pre_req : '',

            })
          }
        },
        methods: {
          getResults(page = 1) {
            axios.get('api/courses?page=' + page)
                .then(response => {
                    this.courses = response.data;
                });
          },
          updateCourse(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/courses/'+this.form.id)
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
            editModal(course){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(course);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
             deleteCourse(id){
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
                                this.form.delete('api/courses/'+id).then(()=>{
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
          loadCourses(){
            if(this.$gate.isSuperAdmin()){
                axios.get("api/courses").then(({data}) =>(this.courses = data))
                .then($data=>{this.totalrecord=$data.total});
            }
            
          },

          createCourse(){
                this.$Progress.start();
                this.form.post('api/courses')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Course Created in successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  this.$Progress.fail();
                })
            }
        },
        created() {
          Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findCourse?q=' + query)
                .then((data) => {
                    this.courses = data.data
                    this.totalrecord= data.data.total

                })
                .catch(() => {
                  swal("Failed!", "No Record Found!.", "warning");
                })
            })
           this.loadCourses();
           Fire.$on('AfterCreate',() => {
               this.loadCourses();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
