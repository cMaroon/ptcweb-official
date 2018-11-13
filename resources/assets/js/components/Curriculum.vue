<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Curriculum Table</h3>

                <div class="card-tools">
                   <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-plus-square fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Curriculum Year Level</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="curr in curriculum.data" :key = "curr.id">
                 
                    <td>{{curr.curryearlevel.title}}</td>
                    <td>{{curr.currsemester.title}}</td>
                    <td>{{curr.currprograms.program_code}}</td>
                    <td>{{curr.currcourses.course_code}}</td>
                    <td>{{curr.currsection.title}}</td>
                    <td>{{curr.sched_days}}</td>
                    <td>{{curr.sched_time}}</td>
                    <td>{{curr.sched_room}}</td>
                    <td>
                      <a href="#" @click="editModal(curr)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteCurr(curr.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Curriculum : {{totalrecord}}</p>

                  <pagination :data="curriculum" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Curriculum's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateCurr() : createCurr()">
              <div class="modal-body">

                    <div class="form-group">
                    <select  type="text" name="curr_year" class="form-control"  required v-model="form.curr_year" >
                            <option value="">Please select year level*</option>
                        <option v-for="yearlevel in yearlevel.data" :key="yearlevel.id" v-bind:value="yearlevel.id">{{yearlevel.title}}</option>

                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" name="semester" class="form-control"  required v-model="form.semester" >
                            <option value="">Please select semester*</option>
                        <option v-for="sem in semester.data" :key="sem.id" v-bind:value="sem.id">{{sem.title}}</option>

                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.curr_program_id">
                            <option value="">Please select program*</option>
                        <option v-for="program in programs.data" :key="program.id" v-bind:value="program.id">{{program.program_code}} - {{program.descriptive_title}}</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.curr_course_id">
                            <option value="">Please select course*</option>
                        <option v-for="course in courses" :key="course.id" v-bind:value="course.id">{{course.course_code}} - {{course.descriptive_title}}</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <select  type="text" class="form-control" v-model="form.curr_section_id">
                            <option value="">Please select section*</option>
                        <option v-for="sec in section.data" :key="sec.id" v-bind:value="sec.id">{{sec.title}}</option>
                    </select>
                    </div>

                    <div class="form-group">
                      <input v-model="form.sched_days" type="text" name="sched_days"
                      placeholder="Schedule Days"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('sched_days') }">
                      <has-error :form="form" field="sched_days"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.sched_time" type="text" name="sched_time"
                      placeholder="Schedule Time"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('sched_time') }">
                      <has-error :form="form" field="sched_time"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.sched_room" type="text" name="sched_room"
                      placeholder="Schedule Room"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('sched_room') }">
                      <has-error :form="form" field="sched_room"></has-error>
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
            programs : {},
            courses : {},
            yearlevel : {},
            section:{},
            semester : {},
            curriculum : {},
            totalrecord:'',
            form: new Form({
                id : '',
                curr_year : '',
                semester : '',
                curr_program_id : '',
                curr_course_id : '',
                curr_section_id : '',
                sched_days:'',
                sched_time:'',
                sched_room:''

            })
          }
        },
        methods: {
          getResults(page = 1) {
            axios.get('api/curriculum?page=' + page)
                .then(response => {
                    this.curriculum = response.data;
                });
          },
          updateCurr(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/curriculum/'+this.form.id)
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
            editModal(curr){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(curr);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
             deleteCurr(id){
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
                                this.form.delete('api/curriculum/'+id).then(()=>{
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
          loadCurriculum(){
            if(this.$gate.isSuperAdmin()){
                axios.get("api/courselist").then(({data}) =>(this.courses = data))
                axios.get("api/section").then(({data}) =>(this.section = data))
                axios.get("api/program").then(({data}) =>(this.programs = data))                
                axios.get("api/yearlevel").then(({data}) =>(this.yearlevel = data))                
                axios.get("api/semester").then(({data}) =>(this.semester = data))                
                axios.get("api/curriculum").then(({data}) =>(this.curriculum = data))
                .then($data=>{this.totalrecord=$data.total});
            }
            
          },

          createCurr(){
                this.$Progress.start();
                this.form.post('api/curriculum')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Curriculum Created in successfully'
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
                axios.get('api/findCurr?q=' + query)
                .then((data) => {
                    this.curriculum = data.data
                    this.totalrecord= data.data.total
                })
               .catch(() => {
                // swal("Failed!", "No Record Found!.", "warning");
                })
            })
           this.loadCurriculum();
           Fire.$on('AfterCreate',() => {
               this.loadCurriculum();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
