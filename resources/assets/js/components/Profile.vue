<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 220px !important;
}
.widget-user .card-footer{
    padding: 0;
}
.widget-user .widget-user-image > img {
    width: 150px !important;
    height: 150px !important;
    margin-left: -30px !important;
}
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./img/hero.png')">
               
                    <h3 class="widget-user-username">{{this.form.firstname}} {{this.form.middlename}} {{this.form.lastname}}</h3>
                    <h5 class="widget-user-desc" >ID Number: {{this.form.id_num}}</h5>
                    <h5 class="widget-user-desc" >Email: {{this.form.cd_email}}</h5>

                </div>
                <div class="widget-user-image">
                    <!-- <img class="img-circle elevation-2" :src="getProfilePhoto()" alt="User Avatar"> -->
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">Year Level</h5>
                        <span class="description-text">{{this.form.year_level}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">Section</h5>
                        <span class="description-text">{{this.form.section}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">Program</h5>
                        <span class="description-text">{{this.form.acad_program}}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#information" data-toggle="tab">Information</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="information">
                                <form class="form-horizontal">
                                        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>General Information</b></h5></div>
                <div class="panel-body">   
                    <div class="row">
                        <div class="col-sm-3">Suffix Name: <input type="text" v-model="form.suffixname" class="form-control" id="sname" name="sname" maxlength="3" placeholder="(e.g. Jr.)"></div>
                        <div class="col-sm-3">Sex: 
                            <select v-model="form.sex" class="form-control" id="sex" name="sex" >
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-3">Civil Status: 
                            <select v-model="form.civil_status" class="form-control" id="civil_status" name="civil_status" >
                                <option value=""></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                        <div class="col-sm-3">Citizenship: <input v-model="form.citizenship" type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Citizenship" ></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">Birthplace: <input v-model="form.birthplace" type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Birthplace" ></div>
                        <div class="col-sm-4">Religion: <input v-model="form.religion" type="text" class="form-control" id="religion" name="religion" placeholder="Religion" ></div> 
                        <div class="col-sm-4">Date of Birth:  <input v-model="form.dob" data-provide="datepicker" class="form-control" name="bdate" id="bdate" placeholder="mm/dd/yyyy" maxlength="10" ></div>
                    </div>
                </div>
        </div>
    </div>
<br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>Current Address</b></h5></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">Street No. / Unit No.: <input v-model="form.ca_st_num" type="text" class="form-control" id="add_st_num" name="add_st_num" placeholder="" maxlength="20" ></div>
                        <div class="col-sm-9">Street: <input v-model="form.ca_st_name" type="text" class="form-control" id="add_st_name" name="add_st_name" placeholder="" maxlength="40" ></div>
                    </div>    
                    <br> 
                    <div class="row">
                        <div class="col-sm-6">Subdivision / Village / Building: <input v-model="form.ca_subd" type="text" class="form-control" id="add_subd" name="add_subd" maxlength="40" placeholder=""></div>
                        <div class="col-sm-6">Barangay: <input v-model="form.ca_brgy" type="text" class="form-control" id="add_brgy" name="add_brgy" placeholder="" maxlength="40" ></div>
                    </div>    
                    <br>                    
                    <div class="row">
                        <div class="col-sm-5">City / Municipality: <input v-model="form.ca_city" type="text" class="form-control" id="add_city" name="add_city" placeholder="" maxlength="60" ></div>
                        <div class="col-sm-5">Province: <input v-model="form.ca_province" type="text" class="form-control" id="add_province" name="add_province" placeholder="" maxlength="60" ></div>
                        <div class="col-sm-2">Zip Code: <input v-model="form.ca_zipcode" type="text" class="form-control" id="add_zipcode" name="add_zipcode" placeholder="xxxx" min="4" maxlength="4"  title="4 characters only"></div>                    
                    </div>                         
                </div>
        </div>
    </div>
<br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>Permanent Address</b></h5></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">Street No. / Unit No.: <input v-model="form.per_add_st_num" type="text" class="form-control" id="per_add_st_num" name="per_add_st_num" placeholder="" maxlength="50" ></div>
                        <div class="col-sm-9">Street: <input v-model="form.per_add_st_name" type="text" class="form-control" id="per_add_st_name" name="per_add_st_name" placeholder="" maxlength="100" ></div>
                    </div>    
                    <br> 
                    <div class="row">
                        <div class="col-sm-6">Subdivision / Village / Building: <input v-model="form.per_add_subd" type="text" class="form-control" id="per_add_subd" name="per_add_subd" maxlength="100" placeholder=""></div>
                        <div class="col-sm-6">Barangay: <input v-model="form.per_add_brgy" type="text" class="form-control" id="per_add_brgy" name="per_add_brgy" placeholder="" maxlength="100" ></div>
                    </div>    
                    <br>                    
                    <div class="row">
                        <div class="col-sm-5">City / Municipality: <input v-model="form.per_add_city" type="text" class="form-control" id="per_add_city" name="per_add_city" placeholder="" maxlength="60" ></div>
                        <div class="col-sm-5">Province: <input v-model="form.per_add_province" type="text" class="form-control" id="per_add_province" name="per_add_province" placeholder="" maxlength="60" ></div>
                        <div class="col-sm-2">Zip Code: <input v-model="form.per_add_zipcode" type="text" class="form-control" id="per_add_zipcode" name="per_add_zipcode" placeholder="xxxx" min="4" maxlength="4"  title="4 characters only"></div>     
                    </div>                         
                </div>
        </div>  
    </div>
    <br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>Contact Details</b></h5></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">Telephone No.:<input v-model="form.cd_telno" type="text" class="form-control" id="telno" name="telno" maxlength="30" placeholder="Landline" title="Minimum 7 &amp; Maximum 30 characters only" pattern=".{7,30}"></div>
                        <div class="col-sm-4">Mobile No.: <input v-model="form.cd_mobno" type="text" class="form-control" id="mobno" name="mobno" placeholder="09XXxxxxxxx" maxlength="11"  title="11 characters only" ></div>
                    </div>
                </div>
        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>Last School Attended</b></h5></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            School Type: 
                            <select v-model="form.lastsch_type" name="lastsch_type" id="lastsch_type" class="form-control" >
                                <option value="">Please select type</option>
                                <option value="high school">High School</option>
                                <option value="juinor high school">Juinor High School</option>
                                <option value="senior high school">Senior High School</option>
                                <option value="als/pept">Alternative Learning System Accreditation &amp; Equivalency / Philippine Educational Placement Test</option>
                                <option value="college">College</option>
                            </select>
                        </div>  
                        <div class="col-sm-3">
                            Name of School: <input v-model="form.lastsch_name" type="text" name="lastsch_name" id="lastsch_name" class="form-control" placeholder="Name of School" maxlength="90" >
                        </div>                  
                        <div class="col-sm-3">
                            Program / Track &amp; Strand<input v-model="form.lastsch_program" type="text" name="lastsch_program" id="lastsch_program" class="form-control" placeholder="Program or Track" maxlength="90">
                        </div> 
                        <div class="col-sm-3">
                            Date Last Attended:  <input v-model="form.lastsch_attended" data-provide="datepicker" class="form-control" name="lastsch_attended" id="lastsch_attended" placeholder="mm/dd/yyyy" maxlength="10">
                        </div>
                    </div>    
                </div>
        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h5><b>Parents / Guardian's Information</b></h5></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12"><br><p><b>Father's Information</b></p></div>
                            <div class="col-md-4">First Name<input v-model="form.fa_fname" type="text" class="form-control" name="fathersname" id="fathersname" placeholder="Given Name" maxlength="100"></div>
                            <div class="col-md-4">Last Name<input v-model="form.fa_lname" type="text" class="form-control" name="fatherslname" id="fatherslname" placeholder="Surname" maxlength="100"></div>
                            <div class="col-md-2">Middle Initial<input v-model="form.fa_mname" type="text" class="form-control" name="fathersmname" id="fathersmname" placeholder="Middle initial" maxlength="3"></div>
                            <div class="col-md-2">Suffix<input v-model="form.fa_sname" type="text" class="form-control" name="fatherssname" id="fatherssname" placeholder="(eg. Jr.)" maxlength="3"></div>
                    </div>
                    <br>
                    <div class="row">    
                            <div class="col-md-4">Mobile Number<input v-model="form.fa_mobno" type="text" class="form-control" name="fatherscontact" id="fatherscontact" placeholder="09XXxxxxxxx" maxlength="11" title="11 characters only"></div>
                            <div class="col-md-4">Email<input v-model="form.fa_email" type="email" class="form-control" name="fathersemail" id="fathersemail" placeholder="example@domain.com" maxlength="100"></div>
                            <div class="col-md-4">Occupation<input v-model="form.fa_occu" type="text" class="form-control" name="fathersoccupation" id="fathersoccupation" placeholder="Occupation" maxlength="100"></div>           
                    </div>         
                    <br>
                    <div class="row">
                        <div class="col-md-12"><br><p><b>Mother's Information</b></p></div>
                            <div class="col-md-5">First Name<input v-model="form.mo_fname" type="text" class="form-control" name="mothersname" id="mothersname" placeholder="Given Name" maxlength="100"></div>
                            <div class="col-md-5">Last Name<input v-model="form.mo_lname" type="text" class="form-control" name="motherslname" id="motherslname" placeholder="Surname" maxlength="100"></div>
                            <div class="col-md-2">Middle Initial<input v-model="form.mo_mname" type="text" class="form-control" name="mothersmname" id="mothersmname" placeholder="Middle initial" maxlength="3"></div>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-md-4">Mobile Number<input v-model="form.mo_mobno" type="text" class="form-control" name="motherscontact" id="motherscontact" placeholder="09XXxxxxxxx" maxlength="11" title="11 characters only"></div>
                            <div class="col-md-4">Email<input v-model="form.mo_email" type="email" class="form-control" name="mothersemail" id="mothersemail" placeholder="example@domain.com" maxlength="100"></div>
                            <div class="col-md-4">Occupation<input v-model="form.mo_occu" type="text" class="form-control" name="mothersoccupation" id="mothersoccupation" placeholder="Occupation" maxlength="100"></div>     
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12"><br><p><b>Guardian's Information</b></p></div>
                            <div class="col-md-4">First Name<input v-model="form.gu_fname" type="text" class="form-control" name="guardiansname" id="guardiansname" placeholder="Given Name" maxlength="100"></div>
                            <div class="col-md-4">Last Name<input v-model="form.gu_lname" type="text" class="form-control" name="guardianslname" id="guardianslname" placeholder="Surname" maxlength="100"></div>
                            <div class="col-md-2">Middle Initial<input v-model="form.gu_mname" type="text" class="form-control" name="guardiansmname" id="guardiansmname" placeholder="Middle initial" maxlength="3"></div>
                            <div class="col-md-2">Suffix<input v-model="form.gu_sname" type="text" class="form-control" name="guardianssname" id="guardianssname" placeholder="Suffix" maxlength="3"></div>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-md-3">Mobile Number<input v-model="form.gu_mobno" type="text" class="form-control" name="guardianscontact" id="guardianscontact" placeholder="09XXxxxxxxx" maxlength="11" title="11 characters only"></div>
                            <div class="col-md-3">Email<input v-model="form.gu_email" type="email" class="form-control" name="guardiansemail" id="guardiansemail" placeholder="example@domain.com" maxlength="100"></div>
                            <div class="col-md-3">Occupation<input v-model="form.gu_occu" type="text" class="form-control" name="guardiansoccupation" id="guardiansoccupation" placeholder="Occupation" maxlength="100"></div>
                            <div class="col-md-3">Relationship<input v-model="form.gu_rel" type="text" class="form-control" name="guardiansrelationship" id="guardiansrelationship" placeholder="Relationship" maxlength="100"></div>   
                    </div>
                </div>
        </div>
    </div> 
                                                              
                                <div class="form-group">
                                    <!-- <label for="password" class="col-sm-12 control-label">Password (leave blank if you don't want to change it)</label> -->

                                    <div class="col-sm-12">
                                    <input type="hidden"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-primary">Update <i class="fas fa-pen fa-fw"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>



<script>
    export default {
        data(){
            return { 
                 form: new Form({
                     //important details
                    id : '',
                    id_num : '',
                    cd_email:'',
                    firstname : '',
                    middlename : '',
                    lastname : '',
                    year_level: '',
                    section:'',
                    acad_program:'',
                    profile_photo: '',
                    student_type: '',
                    //supporting details
                    suffixname:'',
                    scholarship:'',
                    sex:'',
                    civil_status:'',
                    citizenship:'',
                    birthplace:'',
                    religion:'',
                    dob:'',
                    //current address
                    ca_st_num:'',
                    ca_st_name:'',
                    ca_subd:'',
                    ca_brgy:'',
                    ca_city:'',
                    ca_province:'',
                    ca_zipcode:'',
                    //permanent address
                    per_st_num:'',
                    per_st_name:'',
                    per_subd:'',
                    per_brgy:'',
                    per_city:'',
                    per_province:'',
                    per_zipcode:'',
                    //contact details
                    cd_telno:'',
                    cd_mobno:'',
                    //school attended
                    lsa_schtype:'',
                    lsa_schname:'',
                    lsa_schprogram:'',
                    lsa_schattended:'',
                    //parent information
                    //father
                    fa_fname:'',
                    fa_mname:'',
                    fa_lname:'',
                    fa_sname:'',
                    fa_mobno:'',
                    fa_email:'',
                    fa_occu:'',
                    //mother
                    mo_fname:'',
                    mo_mname:'',
                    mo_lname:'',
                    mo_mobno:'',
                    mo_email:'',
                    mo_occu:'',
                    //guardian
                    gu_fname:'',
                    gu_mname:'',
                    gu_lname:'',
                    gu_sname:'',
                    gu_mobno:'',
                    gu_email:'',
                    gu_occu:'',
                    gu_rel:'',

                })               
   
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            // getProfilePhoto(){
            //     let profile_photo = "img/profile/"+ this.form.profile_photo ;
            //     return profile_photo;
            // },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/student/'+this.form.id)
                .then(()=>{
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
            // updateProfile(e){
            //     // console.log('uploading');
            //         let file = e.target.files[0];
            //         // console.log(file);
            //         let reader = new FileReader();
            //         // let vm = this;
            //         if(file['size'] < 2111775){
            //             reader.onloadend = (file) => {
            //                 // console.log('RESULT', reader.result)
            //                 this.form.profile_photo = reader.result;
            //             }
            //             reader.readAsDataURL(file);
            //         }else{
            //              swal({
            //                 type: 'error',
            //                 title: 'Exceeded File Size',
            //                 text: 'Maximum upload image file size: 2 MB',
            //             })
            //         }
            // }
        },
        created() {
                // axios.get("api/profile")
                // .then(({ data }) => (this.form.fill(data)));
                axios.get("api/student").then(({ data }) => (this.form.fill(data)));
                // axios.get("api/user").then(({data}) =>(this.users = data.data));

        }
    }

    
                
</script>