<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Enrollment</h3>

                <div class="card-tools">
                   <!-- <button class="btn btn-success" @click="newModal" >Generate Form ID <i class="fas fa-plus-square fa-fw"></i></button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Form ID</th>
                    <th>ID Number</th>
                    <th>Student Name</th>
                    <th>Manage Curriculum</th>
                  </tr>
                  <tr v-for="enroll in enrollList.data" :key = "enroll.id">
                 
                    <td>{{enroll.enr_form_id}}</td>
                    <td>{{enroll.enr_id_num}}</td>
                    <td>{{enroll.studinfo.firstname}} {{enroll.studinfo.lastname}} {{enroll.studinfo.suffixname}}</td>
                    <td>
                <router-link :to="{name: 'manage_curr', params:{id: enroll.id}}" >
                     
                           View Curriculum
         
                </router-link>
                                      |
                       <a href="#" @click="deleteEnroll(enroll.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <p>Total Enrollment : {{totalrecord}}</p>

                  <pagination :data="enrollList" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Generate Form ID</h5>
                    <!-- <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Curriculum's Info</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateEnroll() : createEnroll()">
              <div class="modal-body">

                <div class="form-group">
                      <input v-model="form.enr_form_id" id="random-number" type="text" name="enr_form_id"
                      placeholder="Form ID"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('enr_form_id') }" readonly>
                      <has-error :form="form" field="enr_form_id"></has-error>
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
            student:{},
            programs : {},
            enrollList : {},
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
            axios.get('api/enrollList?page=' + page)
                .then(response => {
                    this.enrollList = response.data;
                });
          },
          updateEnroll(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/enrollList/'+this.form.id)
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
                this.form.enr_form_id = Math.floor(Math.random() * 100000);
                this.form.enr_id_num = this.student.id_num;
                this.form.enr_program_id = this.student.studprograms.id;
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
            if(this.$gate.isSuperAdmin()){
                // axios.get("api/courses").then(({data}) =>(this.courses = data))
                axios.get("api/student").then(({data}) => (this.student = data));
                axios.get("api/program").then(({data}) =>(this.programs = data))                
                axios.get("api/enrollList").then(({data}) =>(this.enrollList = data))
                .then($data=>{this.totalrecord=$data.total});
            }
            
          },


        },
        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findStudentID?q=' + query)
                .then((data) => {
                    this.enrollList = data.data
                    this.totalrecord= data.data.total

                })
                .catch(() => {
                        // swal("Failed!", "No Record Found!.", "warning");
                })
            })
           this.loadEnrollment();
           Fire.$on('AfterCreate',() => {
               this.loadEnrollment();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
