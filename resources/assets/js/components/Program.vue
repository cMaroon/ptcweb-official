<template>
    <div class="container">
      <div class="row mt-3" v-if="$gate.isSuperAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Program Table</h3>

                <div class="card-tools">
                <p>Total Program : {{totalrecord}}</p>
                   <!-- <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Program Code</th>
                    <th>Descriptive Title</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="program in programs.data" :key = "program.id">
                 
                    <td>{{program.program_code}}</td>
                    <td>{{program.descriptive_title}}</td>
                    <td>
                      <a href="#" @click="editModal(program)">
                            <i class="fa fa-edit icon-blue"></i>
                        </a>
                      |
                       <a href="#" @click="deleteUser(program.id)">
                            <i class="fa fa-trash icon-red"></i>
                        </a>
                    </td>
                 
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="programs" :limit="2" @pagination-change-page="getResults">
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
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Program's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateProgram() : createProgram()">
              <div class="modal-body">
                    <div class="form-group">
                      <input v-model="form.program_code" type="text" name="program_code"
                      placeholder="Program Code"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('program_code') }">
                      <has-error :form="form" field="program_code"></has-error>
                    </div>
                    
                    <div class="form-group">
                      <input v-model="form.descriptive_title" type="text" name="descriptive_title"
                      placeholder="Descriptive Title"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('descriptive_title') }">
                      <has-error :form="form" field="descriptive_title"></has-error>
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
            totalrecord:'',
            form: new Form({
                id : '',
                program_code : '',
                descriptive_title : '',

            })
          }
        },
        methods: {
          getResults(page = 1) {
            axios.get('api/program?page=' + page)
                .then(response => {
                    this.programs = response.data;
                });
          },
          updateProgram(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/program/'+this.form.id)
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
            editModal(program){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(program);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
             deleteProgram(id){
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
                                this.form.delete('api/program/'+id).then(()=>{
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
          loadPrograms(){
            if(this.$gate.isSuperAdmin()){
                axios.get("api/program").then(({data}) =>(this.programs = data))
                .then($data=>{this.totalrecord=$data.total-1});
            }
            
          },

          createProgram(){
                this.$Progress.start();
                this.form.post('api/program')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Program Created in successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  this.$Progress.fail();
                })
            }
        },
        created() {
           this.loadPrograms();
           Fire.$on('AfterCreate',() => {
               this.loadPrograms();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        }
    }
</script>
