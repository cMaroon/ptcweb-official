<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isStudent()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">EnrollmentAssoc Table</h3>

                <div class="card-tools">
                   <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-plus-square fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Form ID</th>
                    <th>ID Number</th>
                    <th>Program Code</th>
                    <th>Fee Status</th>
                    <th>My Curriculum</th>
                  </tr>
                  <tr v-for="enroll in enrollment.data" :key = "enroll.id">
                 
                    <td>{{enroll.enr_form_id}}</td>
                    <td>{{enroll.enr_id_num}}</td>
                    <td>{{enroll.enrollprograms.program_code}}</td>
                    <td>{{enroll.fee_status}}</td>
                    <td>
                <router-link to="/dashboard" >
                     
                           Add Curriculum
         
                </router-link>
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Enrollment : {{totalrecord}}</p>

                  <pagination :data="enrollment" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Curriculum's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateEnroll() : createEnroll()">
              <div class="modal-body">

                    <!-- <div class="form-group">
                    <select  type="text" name="curr_year" class="form-control"  required v-model="form.curr_year" >
                            <option value="">Please select year level*</option>
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth Year">Fourth Year</option>
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" name="semester" class="form-control"  required v-model="form.semester" >
                            <option value="">Please select semester*</option>
                            <option value="1st Sem">1st Sem</option>
                            <option value="2nd Sem">2nd Sem</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.curr_program_id">
                        <option v-for="program in programs.data" :key="program.id" v-bind:value="program.id">{{program.program_code}} - {{program.descriptive_title}}</option>
                    </select>
                    </div>

                    <div class="form-group">
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
            programs : {},
            enrollment : {},
            totalrecord:'',
            form: new Form({
                id : '',
                enr_form_id:'',
                enr_id_num:'',
                enr_program_id:'',
                fee_status:'',

            })
          }
        },
        methods: {
          getResults(page = 1) {
            axios.get('api/enrollment?page=' + page)
                .then(response => {
                    this.enrollment = response.data;
                });
          },
          updateEnroll(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/enrollment/'+this.form.id)
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
                                this.form.delete('api/enrollment/'+id).then(()=>{
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
            if(this.$gate.isStudent()){
                // axios.get("api/courses").then(({data}) =>(this.courses = data))
                axios.get("api/program").then(({data}) =>(this.programs = data))                
                axios.get("api/enrollment").then(({data}) =>(this.enrollment = data))
                .then($data=>{this.totalrecord=$data.total});
            }
            
          },

          createEnroll(){
                this.$Progress.start();
                this.form.post('api/enrollment')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Enrollment Form Created in successfully'
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
