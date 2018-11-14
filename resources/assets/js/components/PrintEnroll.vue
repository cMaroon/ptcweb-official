<template>
    <div class="container">
        <div class="row mt-2" v-if="$gate.isSuperAdmin()">
                    <!-- <div class="container" >
                            <div class="row" > -->
                                <!-- <div class="col-12" > -->
                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                               
                                                <div class="col-2">
                                                <a href="" @click.prevent="printme" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>

                                                </div>
                                            </div>
                                            <!-- Main content -->
                                    <div class="invoice p-3 mb-3" style="background-image:url('/img/logo_ptcbw.png');  background-position:relative; background-size: auto; "  >
                                            <!-- title row -->
                                            <div class="row" >

                                        <div class="col-md-2">
                                            <img src="/img/logo.png" style="width:100px" class="img-circle elevation-2" >
                                                <!-- </h4> -->
                                                </div>
                                        <div class="col-md-10">
                                                <small class="float-right">Registration Date: {{Date.now() | setDate}}</small>

                                            <br>
                                                <h2>Pateros Technological College</h2>
                                                <h4>Certificate of Registration</h4>
                                                
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- info row -->
                                            <template v-if="enrollmentassoc.data">
                                            <div class="row invoice-info" >
                                                <div class="col-sm-8 invoice-col" >
                                                <strong>Student Information</strong>
                                                <address>
                                                    <strong>Student ID Number: </strong>
                                                     {{enrollmentassoc.data[0].assocformid.enr_id_num}}<br>
                                                    <strong>Name: </strong>
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.lastname}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.suffixname}}, 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.firstname}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.middlename}}<br>
                                                    <strong>Address: </strong>
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.ca_st_num}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.ca_st_name}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.ca_subd}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.ca_brgy}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.ca_city}}<br>
                                                </address>
                                                </div>

                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col" >
                                                
                                                <b>Form ID# {{enrollmentassoc.data[0].assocformid.enr_form_id}}</b><br>
                                                <b>Program Code: </b> {{enrollmentassoc.data[0].assoccurrid.currprograms.program_code}}<br>
                                                <b>Year Level: </b> {{enrollmentassoc.data[0].assocformid.studinfo.studyearlevel.title}}<br>
                                                <b>Semester: </b> {{enrollmentassoc.data[0].assoccurrid.currsemester.title}}<br>
                                                <!-- <b>Student Status: </b> Regular<br> -->
                                                

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            </template>
                                            <!-- /.row -->

                                            <!-- Table row -->
                                            <div class="row" >
                                                <div class="col-12 table-responsive" >
                                                <table class="table table-striped" >
                                                    <thead>
                                                    <tr>
                                                    <th style="padding:15px;">Course Code</th>
                                                    <th style="padding:15px; text-align:center;">Description</th>
                                                    <th style="padding:15px;">Unit</th>
                                                    <th style="padding:15px;">Lec</th>
                                                    <th style="padding:15px;">Lab</th>
                                                    <th style="padding:15px; text-align:center;">Section</th>
                                                    <th style="padding:15px; text-align:center;">Day</th>
                                                    <th style="text-align:center; padding:15px;">Time</th>
                                                    <th style="padding:15px;">Room</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="enrollassoc in enrollmentassoc.data" :key = "enrollassoc.id">
                                                    <td style="width:130px; padding:15px;">{{enrollassoc.assoccurrid.currcourses.course_code}}</td>
                                                    <td style="padding:15px;">{{enrollassoc.assoccurrid.currcourses.descriptive_title}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.course_unit}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.lec_hr}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.lab_hr}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currsection.title}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px; ">{{enrollassoc.assoccurrid.sched_days}}</td>
                                                    <td style="width:160px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.sched_time}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.sched_room}}</td>
                                                        
                                                    </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="row" >
                                                <div class="col-4">
                                                <p class="lead">Semestral Fees:</p>
                                                    <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody><tr>
                                                            <th style="width:50%">Tuition Fee: </th>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Registration Fee: </th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Library Fee: </th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Medical Fee: </th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cultural: </th>
                                                            <td></td>
                                                            </tr>

                                                        </tbody></table>
                                                </div>

                                                </div>
                                                <!-- /.col -->
                                                <div class="col-4">
                                                <p class="lead" style=" text-align: left">Total Units: {{totalunits}} </p>
                                                
                                                    <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody><tr>
                                                        <th style="width:50%">
                                                            Athletic:</th>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Book Rental: </th>
                                                            <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Laboratory: </th>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Penalty: </th>
                                                                <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Others: </th>
                                                                    <td></td>
                                                                </tr>
                    
                                                    </tbody></table>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                <p class="lead" style=" text-align: left">Total Lab: {{totallab}} </p>
                                                    

                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:50%">
                                                        Advising Officer: </th>
                                                        <template v-if="enrollmentassoc.data">
                                                        <td><small>{{enrollmentassoc.data[0].assocformid.studinfo.studprograms.advisingid.advising_officer_name}}</small></td>
                                                        </template>
                                                    </tr>
                                                    <tr>
                                                        <th>Assessed By:  </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>College Registrar: </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount: </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                                    <td></td>

                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>
                                            <!-- OR NO -->
                                                <div class="col-4">      
                                                <p class="lead">Prelim:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #:
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: </th>
                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Midterm:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #:
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: </th>
                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Finals:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #:
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: </th>
                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>


                                                <!-- /.col -->

                                            </div>

                                            <div class="col-3"><br>
                                                ______________________________<br>
                                                <center><p class="lead">Student's Signature</p></center>
                                            </div>
                                            <!-- /.row -->



                                            </div>
                                            <small >College St., Brgy. Sto. Rosario-Kanluran, Pateros, Metro-Manila Telephone: 02-640-5375 / 02-640-5389</small>

                                            <!-- /.invoice --> 
                        <!-- </div> -->


                            <!-- </div> -->
                        <!-- </div> -->
        </div> 
    </div>
</template>

<script>
    export default {
        data(){
          return{
            editmode: false,
            // courses:{},
            // yearlevel:{},
            // semester:{},
            // enrollment : [],
            enrollmentassoc : {},
            // curriculum:{},
            // student:{},
            // totalunit:{},
            datetoday: new Date('2011-04-11T10:20:30Z'),
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

            printme() {
              window.print();

          },

          loadEnrollment(){
            // if(this.$gate.isStudent()){
                // axios.get("/api/curriculum").then(({data}) =>(this.curriculum = data))
                // axios.get("/api/courses").then(({data}) =>(this.courses = data))
                // axios.get("/api/enrollList").then(({data}) =>(this.enrollment = data))               
                // axios.get("/api/yearlevel").then(({data}) =>(this.yearlevel = data))                
                // axios.get("/api/studentlist").then(({data}) => (this.student = data))
                // axios.get("/api/semester").then(({data}) =>(this.semester = data))                                      
                axios.get("/api/enrollmentassoc/"+this.$route.params.id).then(({data}) =>(this.enrollmentassoc = data))
                .then($data=>{this.totalrecord=$data.total});
            // }


            
          }

         
        },

        created() {
           this.loadEnrollment();
           Fire.$on('AfterCreate',() => {
               this.loadEnrollment();
           });
          //  setInterval(() => this.loadUsers(), 15000);
        },
        computed: {
           totalunits:function(){
               let sum = 0;
               for (let i = 0; i < this.enrollmentassoc.total; i++){
                   sum += (parseInt(this.enrollmentassoc.data[i].assoccurrid.currcourses.course_unit));
               }

               return sum;
           },
        totallab:function(){
               let sum = 0;
               for (let i = 0; i < this.enrollmentassoc.total; i++){
                   sum += (parseInt(this.enrollmentassoc.data[i].assoccurrid.currcourses.lab_hr));
               }

               return sum;
           }
        }

    }
</script>
