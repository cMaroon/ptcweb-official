<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isStudent()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" >My Curriculum </h3>

                <div class="card-tools">
                   <button class="btn btn-success" @click="newModal">Add Course <i class="fas fa-plus-square fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Form ID</th>
                    <th>Semester</th>
                    <th>Year Level</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Instructor</th>
                    <th>General Average</th>
                    <th>Advising Status</th>
                  </tr>
                  <tr v-for="enrollassoc in enrollmentassoc.data" :key = "enrollassoc.id">
                 
                    <td>{{enrollassoc.assocformid.enr_form_id}}</td>
                    <td>{{enrollassoc.assoccurrid.currsemester.title}}</td>
                    <td>{{enrollassoc.assoccurrid.curryearlevel.title}}</td>
                    <td>{{enrollassoc.assoccurrid.currcourses.course_code}}</td>
                    <td>{{enrollassoc.assoccurrid.currsection.title}}</td>
                    <td>{{enrollassoc.assoccurrid.sched_days}}</td>
                    <td style="width:150px; ">{{enrollassoc.assoccurrid.sched_time}}</td>
                    <td>{{enrollassoc.assoccurrid.sched_room}}</td>
                    <td>{{enrollassoc.assoc_prof_id}}</td>
                    <td>{{enrollassoc.assoc_final_grade}}</td>
                    <td>{{enrollassoc.advising_status}}</td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total My Curriculum : {{totalrecord}}</p>

                  <pagination :data="enrollmentassoc" :limit="2" @pagination-change-page="getResults">
                    <span slot="prev-nav"><i class="fas fa-chevron-circle-left"></i></span>
                    <span slot="next-nav"><i class="fas fa-chevron-circle-right"></i></span>
                  </pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isStudent()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Course</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Curriculum's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateEnroll() : createEnroll()">
              <div class="modal-body">

                <div class="form-group">
                      <input v-model="form.assoc_form_id" type="text" name="assoc_form_id"
                      placeholder="Form ID"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('assoc_form_id') }" readonly hidden>
                      <has-error :form="form" field="assoc_form_id"></has-error>
                </div> 

                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.assoc_curr_id">
                            <option value="">Please select course*</option>

                        <option v-for="curr in curriculumlist" v-if="curr.currprograms.id === form.enr_program_id" :key="curr.id" v-bind:value="curr.id">
                            
                            {{curr.currprograms.program_code}} - Section {{curr.currsection.title}} - {{curr.currcourses.course_code}} - {{curr.currcourses.descriptive_title}}
                            </option>
                    </select>
                    </div>

                    <!-- <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.curr_course_id">
                        <option v-for="course in courses.data" :key="course.id" v-bind:value="course.id">{{course.course_code}} - {{course.descriptive_title}}</option>
                    </select>
                    </div> -->
  

                    
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
            courses:{},
            yearlevel:{},
            section:{},
            semester:{},
            enrollment : [],
            enrollmentassoc : {},
            curriculumlist:{},
            totalrecord:'',
            form: new Form({
                id : '',
                assoc_form_id:'',
                assoc_curr_id:'',
                assoc_prof_id:'',
                assoc_final_grade:'',
            enr_program_id:'',

            })
          }
        },
        methods: {
          getResults(page = 1) {
            axios.get('api/enrollmentassoc?page=' + page)
                .then(response => {
                    this.enrollmentassoc = response.data;
                });
          },
          updateEnroll(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/enrollmentassoc/'+this.form.id)
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
            editModal(enroll){
                // this.editmode = true;
                // this.form.reset();
                // $('#addNew').modal('show');
                // this.form.fill(enroll);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                this.form.enr_program_id = this.enrollment.data[0].enr_program_id;
                this.form.assoc_form_id = this.$route.params.id;

                $('#addNew').modal('show');
            },
             deleteEnroll(id){
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
                                this.form.delete('api/enrollmentassoc/'+id).then(()=>{
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
          loadEnrollment(){
            // if(this.$gate.isStudent()){
                axios.get("/api/curriculumlist").then(({data}) =>(this.curriculumlist = data))
                axios.get("/api/section").then(({data}) =>(this.section = data))
                axios.get("/api/courses").then(({data}) =>(this.courses = data))
                axios.get("/api/enrollment").then(({data}) =>(this.enrollment = data))               
                axios.get("/api/yearlevel").then(({data}) =>(this.yearlevel = data))                
                axios.get("/api/semester").then(({data}) =>(this.semester = data))                                      
                axios.get("/api/enrollmentassoc/"+this.$route.params.id).then(({data}) =>(this.enrollmentassoc = data))
                .then($data=>{this.totalrecord=$data.total});
            // }

          },

          createEnroll(){
                this.$Progress.start();
                this.form.post('/api/enrollmentassoc')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Course Added in successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  this.$Progress.fail();
                })
            }
        },
        created() {
           this.loadEnrollment();
           Fire.$on('AfterCreate',() => {
               this.loadEnrollment();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
