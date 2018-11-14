<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" >Students Curriculum </h3>

                <div class="card-tools">
                    <router-link :to="{name: 'printenroll', params:{id: this.$route.params.id}}" >
                            Print Preview  <i class="fas fa-print icon-green"></i>
                        </router-link>
                   <!-- <button class="btn btn-success" @click="'/enrollprint'+ query">Print <i class="fas fa-print fa-fw"></i></button> -->
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
                    <th>Instructor</th>
                    <th>General Average</th>
                    <th>Advising Status</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="enrollassoc in enrollmentassoc.data" :key = "enrollassoc.id">
                 
                    <td>{{enrollassoc.assocformid.enr_form_id}}</td>
                    <td>{{enrollassoc.assoccurrid.currsemester.title}}</td>
                    <td>{{enrollassoc.assoccurrid.curryearlevel.title}}</td>
                    <td>{{enrollassoc.assoccurrid.currcourses.course_code}}</td>
                    <td>{{enrollassoc.assoccurrid.currsection.title}}</td>
                    <td>{{enrollassoc.assoc_prof_id}}</td>
                    <td>{{enrollassoc.assoc_final_grade}}</td>
                    <td>{{enrollassoc.advising_status}}</td>
                    <td>
                      <a href="#" @click="editModal(enrollassoc)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteEnroll(enrollassoc.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                        
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Student Curriculum : {{totalrecord}}</p>

                  <pagination :data="enrollmentassoc" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Course</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Curriculum's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateEnroll() : createEnroll()">
              <div class="modal-body">


                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.advising_status">
                        <option value="approved" >Approved</option>
                        <option value="not yet approve" >Not Yet Approve</option>
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
            courses:{},
            yearlevel:{},
            semester:{},
            enrollment : [],
            enrollmentassoc : {},
            curriculum:{},
            totalrecord:'',
            form: new Form({
                id : '',
                assoc_form_id:'',
                assoc_curr_id:'',
                assoc_prof_id:'',
                assoc_final_grade:'',
                advising_status:'',
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
            editModal(enrollassoc){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(enrollassoc);
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
                                this.form.delete('/api/enrollmentassoc/'+id).then(()=>{
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
                axios.get("/api/curriculum").then(({data}) =>(this.curriculum = data))
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
                this.form.post('api/enrollmentassoc')
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
            // Fire.$on('searching',() => {
            //     let query = this.$parent.search;
            //     axios.get('api/findFormID?q=' + query)
            //     .then((data) => {
            //         this.enrollmentassoc = data.data
            //         this.totalrecord= data.data.total

            //     })
            //     .catch(() => {
            //             swal("Failed!", "No Record Found!.", "warning");
            //     })
            // })
           this.loadEnrollment();
           Fire.$on('AfterCreate',() => {
               this.loadEnrollment();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
